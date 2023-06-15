<?php

namespace Rgbcode_authform\classes\routes\api;

use Rgbcode_authform\classes\helpers\Authorization;
use Rgbcode_authform\classes\helpers\Request_Api;

abstract class Base_Route {

	protected $api_endpoint = '';

	protected $auth;

	public function __construct() {
		$this->auth = new Authorization();
	}

	public function post( \WP_REST_Request $request ) {

		$nonce = $request->get_header( 'X-WP-Nonce' );

		if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
			wp_send_json_error();
		}

		wp_send_json(
			[
				'success' => true,
				'link'    => 'https://www.google.com',
			]
		);
		exit();
		$data     = $request->get_params();
		$response = Request_Api::send_api(
			$this->get_url_for_request(),
			wp_json_encode( $this->get_body( $data ) ),
			'POST',
			$this->get_headers()
		);

		if ( ! $response ) {
			wp_send_json_error( __( 'Error on client server. Check Request_Api log', 'rgbcode-authform' ) );
		}

		if ( isset( $response['error'] ) ) {
			wp_send_json_error( $response['error'][0]['description'] );
		}

		$result = [
			'success' => 'ok' === $response['data']['status'],
			'link'    => Request_Api::get_response_link( $response['data']['loginToken'] ?? '' ),
		];

		wp_send_json( $result );
	}

	protected function get_body( array $data ): array {
		$referral_data = $this->extract_referral_data( $data );

		$result = array(
			'email'     => sanitize_email( $data['email'] ?? '' ),
			'country'   => sanitize_text_field( $data['iso'] ?? '' ),
			'firstName' => sanitize_text_field( $data['firstname'] ?? '' ),
			'lastName'  => sanitize_text_field( $data['lastname'] ?? '' ),
			'phone'     => sanitize_text_field( ( $data['phonecountry'] ?? '' ) . ( $data['phone'] ?? '' ) ),
			'language'  => $this->get_site_language(),
		);

		if ( $referral_data['referral'] ) {
			$result['referral'] = sanitize_text_field( $referral_data['referral'] );
		}

		if ( $referral_data['clientSource'] ) {
			$result['clientSource'] = sanitize_text_field( $referral_data['clientSource'] );
		}

		return $result;
	}

	private function extract_referral_data( array $data ): ?array {
		$referral_src = sanitize_text_field( $data['referral'] ?? '' );
		$cid          = sanitize_text_field( $data['cid'] ?? '' );

		if ( ! $referral_src ) {
			return null;
		}

		$referral_src = urldecode( $referral_src );
		$referral_arr = explode( '|', $referral_src );

		$referral_data = [];
		foreach ( $referral_arr as $item ) {
			$param = explode( '=', $item );

			if ( $param ) {
				$referral_data[ $param[0] ] = $param[1] ?? '';
			}
		}

		if ( $cid ) {
			$referral_data['cid'] = $cid;
		}

		$client_source = $referral_data['clientSource'] ?? '';

		if ( isset( $referral_data['clientSource'] ) ) {
			unset( $referral_data['clientSource'] );
		}

		$referral_back = [];
		foreach ( $referral_data as $key => $value ) {
			$referral_back[] = "$key=$value";
		}
		$referral = implode( '|', $referral_back );

		return [
			'clientSource' => $client_source,
			'referral'     => $referral,
		];
	}

	private function get_headers(): array {
		return [
			'Authorization' => $this->auth->get_auth_data(),
			'Content-Type'  => 'application/json',
		];
	}

	private function get_url_for_request(): string {
		return $this->auth::BASE_URL_API . $this->api_endpoint;
	}

	private function send_error( $response ) {
		$error = (array) $response['ErrorDetails']->Message;
		wp_send_json_error( $error[0] );
	}

	private function get_site_language(): ?string {
		$language = get_field( 'rgbc_authform_lang', 'option' );

		if ( ! $language ) {
			return 'enu';
		}

		$convert = [
			'en' => 'enu',
			'ar' => 'ara',
			'es' => 'spa',
		];

		return $convert[ $language ] ?? 'enu';
	}

}

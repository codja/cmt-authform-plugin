<?php

namespace Rgbcode_authform\classes\routes\api;

use Rgbcode_authform\classes\helpers\Request_Api;

abstract class Base_Route {

	private const PARTNER_ID         = 75028;
	private const PARTNER_SECRET_KEY = 'fc12bfdcdcab2f63b3f0dfaa9f8ed7b9e8368620ffbc8002b6ea72cb72cacad1';
	private const BASE_URL_API       = 'https://cmtrading.pandats-api.io/api/v3/';
	protected $api_endpoint          = '';

	public function post( \WP_REST_Request $request ) {

		$nonce = $request->get_header( 'X-WP-Nonce' );

		if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
			wp_send_json_error();
		}

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

		$response = json_decode( $response, true );

		if ( isset( $response['error'] ) ) {
			wp_send_json_error( $response['error'][0]['description'] );
		}

		$result = array(
			'success' => 'ok' === $response['data']['status'],
			'link'    => $this->get_response_link( $response['data']['loginToken'] ?? '', 'action' ),
		);

		wp_send_json( $result );
	}

	protected function get_body( array $data ): array {
		$referral_data = $this->extract_referral_data( $data );

		$result = array(
			'email'     => sanitize_email( $data['email'] ?? '' ),
			'country'   => sanitize_text_field( $data['countryiso2'] ?? '' ),
			'firstName' => sanitize_text_field( $data['firstname'] ?? '' ),
			'lastName'  => sanitize_text_field( $data['lastname'] ?? '' ),
			'phone'     => sanitize_text_field( ( $data['phonecountry'] ?? '' ) . ( $data['phone'] ?? '' ) ),
			'language'  => $this->get_site_language( sanitize_text_field( $data['language'] ?? '' ) ),
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

	private function get_access_key(): string {
		return sha1( self::PARTNER_ID . time() . self::PARTNER_SECRET_KEY );
	}

	private function authorization() {
		$data = [
			'partnerId' => self::PARTNER_ID,
			'time'      => time(),
			'accessKey' => $this->get_access_key(),
		];

		return Request_Api::send_api(
			self::BASE_URL_API . 'authorization',
			wp_json_encode( $data ),
			'POST',
			[
				'Content-Type' => 'application/json',
			]
		);
	}

	private function get_jwt_token() {
		$exist_token = get_option( 'panda_token' ) ? json_decode( get_option( 'panda_token' ), true ) : false;

		if ( $exist_token && $exist_token['expire'] > time() ) {
			return $exist_token['token'];
		}

		$authorization = $this->authorization();

		if ( ! $authorization ) {
			wp_send_json_error( __( 'Error on client server. Check Request_Api log', 'rgbcode-authform' ) );
		}

		$authorization = json_decode( $authorization, true );

		if ( isset( $authorization['error'] ) ) {
			wp_send_json_error( $authorization['error'][0]['description'] );
		}

		$token_data = [
			'token'  => $authorization['data']['token'],
			'expire' => strtotime( $authorization['data']['expire'] ),
		];

		update_option( 'panda_token', wp_json_encode( $token_data ) );

		return $token_data['token'];
	}

	private function get_auth_data(): string {
		return 'Bearer ' . $this->get_jwt_token();
	}

	private function get_headers(): array {
		return array(
			'Authorization' => $this->get_auth_data(),
			'Content-Type'  => 'application/json',
		);
	}

	private function get_url_for_request(): string {
		return self::BASE_URL_API . $this->api_endpoint;
	}

	private function send_error( $response ) {
		$error = (array) $response['ErrorDetails']->Message;
		wp_send_json_error( $error[0] );
	}

	private function get_site_language( $language ): ?string {
		if ( ! $language ) {
			return null;
		}

		$convert = [
			'en-US' => 'enu',
			'ar-SA' => 'ara',
			'ru-RU' => 'rus',
		];

		return $convert[ $language ] ?? 'enu';
	}

	private function get_response_link( $url, $param ) {
		if ( ! $url ) {
			return get_home_url();
		}

		if ( ! $param ) {
			return $url;
		}

		$base_url = strtok( $url, '?' );
		$query    = wp_parse_url( $url )['query'];

		parse_str( $query, $parameters );
		unset( $parameters[ $param ] );
		$new_query = http_build_query( $parameters );

		return $base_url . '?' . $new_query;
	}

}

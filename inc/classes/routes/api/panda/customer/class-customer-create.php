<?php

namespace Rgbcode_authform\classes\routes\api\panda\customer;

use Rgbcode_authform\classes\helpers\Request_Api;
use Rgbcode_authform\classes\routes\Routes;

class Customer_Create extends Customer {

	public function post( \WP_REST_Request $request ) {
		Routes::check_nonce( $request );

		$data     = $request->get_params();
		$response = Request_Api::send_api(
			$this->get_url_for_request(),
			wp_json_encode( $this->get_body( $data ) ),
			'POST',
			$this->get_headers()
		);
		$this->check_response( $response );

		$result = [
			'success' => 'ok' === $response['data']['status'],
			'email'   => sanitize_email( $request->get_param( 'email' ) ),
		];

		wp_send_json( $result );
	}

	protected function get_body( array $data ): array {
		$referral_data = $this->extract_referral_data( $data );

		$result = [
			'email'                    => sanitize_email( $data['email'] ?? '' ),
			'country'                  => sanitize_text_field( $data['iso'] ?? '' ),
			'firstName'                => sanitize_text_field( $data['firstname'] ?? '' ),
			'lastName'                 => sanitize_text_field( $data['lastname'] ?? '' ),
			'phone'                    => sanitize_text_field( ( $data['phonecountry'] ?? '' ) . ( $data['phone'] ?? '' ) ),
			'password'                 => sanitize_text_field( $data['password'] ?? '' ),
			'acceptTermsAndConditions' => $this->get_tcc_checked( sanitize_text_field( $data['agree'] ?? '' ) ),
			'language'                 => $this->get_site_language(),
		];

		if ( $referral_data['referral'] ) {
			$result['referral'] = sanitize_text_field( $referral_data['referral'] );
		}

		if ( $referral_data['clientSource'] ) {
			$result['clientSource'] = sanitize_text_field( $referral_data['clientSource'] );
		}

		return $result;
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

	private function get_tcc_checked( string $agree ): bool {
		return $agree === 'on';
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

}

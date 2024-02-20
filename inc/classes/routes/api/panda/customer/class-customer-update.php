<?php

namespace Rgbcode_authform\classes\routes\api\panda\customer;

use Rgbcode_authform\classes\helpers\Request_Api;
use Rgbcode_authform\classes\routes\Routes;

class Customer_Update extends Customer {

	public function put( \WP_REST_Request $request ) {
		Routes::check_nonce( $request );

		$data  = $request->get_params();
		$email = sanitize_email( $data['email'] ?? '' );

		if ( ! $email ) {
			wp_send_json_error( __( 'Email is required', 'rgbcode-authform' ) );
		}

		if ( $this->update_customer( $data, $email ) ) {
			$this->send_join_link( $email );
		}
	}

	protected function get_body( array $data ): array {
		return [
			'currency'   => sanitize_text_field( $data['currency'] ?? '' ),
			'city'       => sanitize_text_field( trim( $data['city'] ?? '' ) ),
			'address'    => sanitize_text_field( trim( $data['address'] ?? '' ) ),
			'postalCode' => sanitize_text_field( trim( $data['postcode'] ?? '' ) ),
			'country'    => sanitize_text_field( $data['country'] ?? '' ),
			'birthday'   => $this->convert_date( $data['birthday'] ?? '' ),
		];
	}

	private function update_customer( array $data, string $email ): bool {
		$response = Request_Api::send_api(
			$this->get_url_for_request() . '/' . rawurlencode( $email ),
			wp_json_encode( $this->get_body( $data ) ),
			'PUT',
			$this->get_headers()
		);
		$this->check_response( $response );

		return isset( $response['data']['status'] ) && $response['data']['status'] === 'ok';
	}

	private function send_join_link( string $email ) {
		$response = Request_Api::send_api(
			$this->auth::BASE_URL_API . 'system/loginToken',
			wp_json_encode(
				[
					'email' => $email,
				]
			),
			'POST',
			$this->get_headers()
		);
		$this->check_response( $response );

		/**
		 * It is triggered after receiving data from panda with a generated redirect link.
		 *
		 * @date    28/01/24
		 *
		 * @param  array $result.
		 */
		$result = apply_filters(
			'authform_link_for_redirect_after_deposit',
			[
				'success' => true,
				'link'    => Request_Api::get_response_link( $response['data']['url'] ?? '' ),
			]
		);

		wp_send_json( $result );
	}

	/*
	 * Expected incoming format DD/MM/YYY
	 * Convert date to format YYYY-MM-DD
	*/
	private function convert_date( string $date ): ?string {
		if ( ! $date ) {
			return null;
		}

		$date = sanitize_text_field( $date );
		$date = explode( '/', $date );

		if ( ! $date || empty( $date[0] ) || empty( $date[1] ) || empty( $date[2] ) ) {
			wp_send_json_error( __( 'Error with date (birthday) format', 'rgbcode-authform' ) );
		}

		$date = "{$date[2]}/{$date[1]}/{$date[0]}";

		return wp_date( 'Y-m-d', strtotime( $date ) );
	}
}

<?php

namespace Rgbcode_authform\classes\routes\api\panda\customer;

use Rgbcode_authform\classes\helpers\Request_Api;
use Rgbcode_authform\classes\routes\Routes;

class Customer_Update extends Customer {

	public function put( \WP_REST_Request $request ) {
		Routes::check_nonce( $request );

		$data  = $request->get_params();
		$email = sanitize_email( $data['email'] ?? '' );

		if ( empty( $email ) ) {
			wp_send_json_error( __( 'Email is required', 'rgbcode-authform' ) );
		}

		if ( $this->update_customer( $data, $email ) ) {
			$this->send_join_link( $email );
		}
	}

	protected function get_body( array $data ): array {
		return [
			'currency'   => sanitize_text_field( $data['currency'] ?? '' ),
			'city'       => sanitize_text_field( $data['city'] ?? '' ),
			'address'    => sanitize_text_field( $data['address'] ?? '' ),
			'postalCode' => sanitize_text_field( $data['postcode'] ?? '' ),
			'country'    => sanitize_text_field( $data['country'] ?? '' ),
			'birthday'   => sanitize_text_field( $data['birthday'] ?? '' ),
		];
	}

	private function update_customer( array $data, string $email ): bool {
		$response = Request_Api::send_api(
			$this->get_url_for_request() . '/' . $email,
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

		$result = [
			'success' => true,
			'link'    => Request_Api::get_response_link( $response['data']['url'] ?? '' ),
		];

		wp_send_json( $result );
	}
}

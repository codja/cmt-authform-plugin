<?php

namespace Rgbcode_authform\classes\routes\api\panda;

use Rgbcode_authform\classes\helpers\Request_Api;
use Rgbcode_authform\classes\Panda_DB;
use Rgbcode_authform\classes\routes\Routes;

class Login extends Panda {

	protected $api_endpoint = 'system/loginToken';

	public function post( \WP_REST_Request $request ) {
		Routes::check_nonce( $request );
		// check existing user in panda db and get his password.
		$data  = $request->get_params();
		$email = isset( $data['email'] ) && is_email( $data['email'] ) ? sanitize_email( $data['email'] ) : '';
		var_dump( Panda_DB::instance()->get_user_register_data( 'email', $email, '*' ) );die;
		// check password

		$response = Request_Api::send_api(
			$this->get_url_for_request(),
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
			'success'  => isset( $response['data']['url'] ),
			'loginUrl' => Request_Api::get_response_link( $response['data']['url'] ?? false ),
		];

		wp_send_json( $result );
	}

}

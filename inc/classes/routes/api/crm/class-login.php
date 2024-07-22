<?php

namespace Rgbcode_authform\classes\routes\api\crm;

use Rgbcode_authform\classes\routes\Routes;

class Login extends CRM {

	public function post( \WP_REST_Request $request ) {
		Routes::check_nonce( $request );

		$data     = $request->get_params();
		$response = $this->provider->login->send_request( $data, $this->provider );
		$result   = $this->provider->login->get_result( $response, $request );

		/**
		 * Fires after login user in the CRM.
		 *
		 * @date    28/01/24
		 *
		 * @param  array $result.
		 */
		do_action( 'authform_after_login', $result );

		wp_send_json( $result );
	}

}

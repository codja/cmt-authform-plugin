<?php

namespace Rgbcode_authform\classes\routes\api\crm\customer;

use Rgbcode_authform\classes\CRM_DB;
use Rgbcode_authform\classes\providers\antelope\Antelope_CRM;
use Rgbcode_authform\classes\routes\Routes;

class Customer_Update {

	/**
	 * Handles a PUT request to update user data and generate a redirect link.
	 *
	 * @param \WP_REST_Request $request The REST API request object.
	 *
	 * @return void
	 */
	public function put( \WP_REST_Request $request ) {
		Routes::check_nonce( $request );

		$data        = $request->get_params();
		$email       = sanitize_email( $data['email'] ?? '' );
		$customer_id = sanitize_text_field( $data['customerID'] ?? '' );

		if ( ! $email || ! $customer_id) {
			wp_send_json_error( __( 'Required data not transmitted', 'rgbcode-authform' ) );
		}

		// Fetch user registration data from the CRM database.
		$user_data = CRM_DB::instance()->get_user_register_data(
			'email',
			$email,
			'customer_id, accountid'
		);

		// Extract database values.
		$db_customer_id     = $user_data['customer_id'] ?? '';
		$data['account_id'] = $user_data['accountid'] ?? '';
		if ( $db_customer_id !== $customer_id || ! $data['account_id'] ) {
			wp_send_json_error( __( 'User not found', 'rgbcode-authform' ) );
		}

		$provider = new Antelope_CRM();
		$response = $provider->send_request( $provider->update->get_endpoint(), $provider->update->get_body( $data ), 'PUT' );

		$provider->check_response( $response );

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
				'link'    => $this->create_link( $email, $customer_id ),
			]
		);

		wp_send_json( $result );
	}

	private function create_link( string $email, string $customer_id ): string {

		return add_query_arg(
			[
				'emailaddress' => $email,
				'account_no'   => $customer_id,
			],
			'https://services.cmtrading.com/autologin'
		);
	}
}

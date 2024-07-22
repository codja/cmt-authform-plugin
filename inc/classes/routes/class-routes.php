<?php

namespace Rgbcode_authform\classes\routes;

use Rgbcode_authform\classes\routes\api\crm\Login;
use Rgbcode_authform\classes\routes\api\Detect_Location;
use Rgbcode_authform\classes\routes\api\crm\customer\Customer_Create;
use Rgbcode_authform\classes\routes\api\crm\customer\Customer_Update;
use WP_REST_Server;

class Routes {
	public function __construct() {
		add_action(
			'rest_api_init',
			function () {
				register_rest_route(
					'rgbcode/v1',
					'/customer',
					[
						[
							'methods'  => WP_REST_SERVER::CREATABLE,
							'callback' => [ new Customer_Create(), 'post' ],
						],
						//                      [
						//                          'methods'  => 'PUT',
						//                          'callback' => [ new Customer_Update(), 'put' ],
						//                      ],
					]
				);
			}
		);

		add_action(
			'rest_api_init',
			function () {
				register_rest_route(
					'rgbcode/v1',
					'/login',
					[
						'methods'  => WP_REST_SERVER::CREATABLE,
						'callback' => [ new Login(), 'post' ],
						'args'     => [
							'email'    => [
								'type'     => 'string',
								'format'   => 'email',
								'required' => true,
							],
							'password' => [
								'type'     => 'string',
								'format'   => 'password',
								'required' => true,
							],
						],
					]
				);
			}
		);

		add_action(
			'rest_api_init',
			function () {
				register_rest_route(
					'rgbcode/v1',
					'/detect_location',
					[
						'methods'  => WP_REST_SERVER::READABLE,
						'callback' => [ new Detect_Location(), 'get' ],
					]
				);
			}
		);
	}

	public static function check_nonce( \WP_REST_Request $request ): bool {
		$nonce = $request->get_header( 'X-WP-Nonce' );

		if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
			wp_send_json_error( __( 'Invalid nonce', 'rgbcode-authform' ), 400 );
		}

		return true;
	}

}

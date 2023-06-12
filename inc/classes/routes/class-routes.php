<?php

namespace Rgbcode_authform\classes\routes;

use Rgbcode_authform\classes\routes\api\Create_Account;
use Rgbcode_authform\classes\routes\api\Detect_Location;

class Routes {
	public function __construct() {
		add_action(
			'rest_api_init',
			function () {
				register_rest_route(
					'rgbcode/v1',
					'/create_account',
					[
						'methods'  => 'POST',
						'callback' => [ new Create_Account(), 'post' ],
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
						'methods'  => 'GET',
						'callback' => [ new Detect_Location(), 'get' ],
					]
				);
			}
		);
	}

}
new Routes();

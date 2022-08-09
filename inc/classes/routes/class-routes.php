<?php

namespace Rgbcode_authform\classes\routes;

use Rgbcode_authform\classes\routes\api\Create_Account;

class Routes {

	public function __construct() {
		add_action(
			'rest_api_init',
			function () {
				register_rest_route(
					'rgbcode/v1',
					'/create_account',
					array(
						'methods'  => 'POST',
						'callback' => [ new Create_Account(), 'post' ],
					)
				);
			}
		);
	}

}
new Routes();

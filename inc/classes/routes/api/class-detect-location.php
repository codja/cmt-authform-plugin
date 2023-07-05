<?php

namespace Rgbcode_authform\classes\routes\api;

use Rgbcode_authform\classes\helpers\Location;
use Rgbcode_authform\classes\routes\Routes;

class Detect_Location {

	public function get( \WP_REST_Request $request ) {
		Routes::check_nonce( $request );

		$default_country                   = Location::get_default_country();
		$default_country['country']['src'] = esc_url( RGBCODE_AUTHFORM_IMAGES . '/flags/' . strtolower( $default_country['country']['iso'] ?? 'af' ) . '.svg' );

		wp_send_json_success( $default_country );
	}

}

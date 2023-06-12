<?php

namespace Rgbcode_authform\classes\routes\api;

use Rgbcode_authform\classes\helpers\Location;

class Detect_Location {

	public function get( \WP_REST_Request $request ) {
		$nonce = $request->get_header( 'X-WP-Nonce' );

		if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
			wp_send_json_error();
		}

		$default_country                   = Location::get_default_country();
		$default_country['country']['src'] = esc_url( RGBCODE_AUTHFORM_IMAGES . '/flags/' . strtolower( $default_country['country']['iso'] ?? 'af' ) . '.svg' );

		wp_send_json_success( $default_country );
	}

}

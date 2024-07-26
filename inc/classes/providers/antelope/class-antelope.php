<?php

namespace Rgbcode_authform\classes\providers\antelope;

use Rgbcode_authform\classes\core\Error;

abstract class Antelope {

	public const BASE_URL_API = '';

	public function check_response( $response ) {
		if ( ! $response ) {
			wp_send_json_error( __( 'Error on client server. Check Request_Api log', 'rgbcode-authform' ) );
		}

		if ( isset( $response['error'] ) ) {
			$description   = $response['error']['errorDesc'] ?? '';
			$error_log_msg = ' request_id[' . ( $response['requestId'] ?? '' ) . ']: ' . $description . ' ' . ( $response['error']['errorDetails'] ?? '' );
			Error::instance()->log_error( 'Antelope_Api', $error_log_msg );
			wp_send_json_error( $description . ' (error code: {' . ( $response['requestId'] ?? '' ) . '})' );
		}
	}

	protected function get_headers(): array {

		return [
			'Content-Type' => 'application/json',
			'Accept'       => 'application/json',
		];
	}

}

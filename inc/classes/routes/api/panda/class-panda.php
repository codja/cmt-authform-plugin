<?php

namespace Rgbcode_authform\classes\routes\api\panda;

use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\helpers\Authorization;

abstract class Panda {

	protected $api_endpoint = '';

	protected $auth;

	public function __construct() {
		$this->auth = new Authorization();
	}

	protected function get_headers(): array {
		return [
			'Authorization' => $this->auth->get_auth_data(),
			'Content-Type'  => 'application/json',
		];
	}

	protected function get_url_for_request(): string {
		return $this->auth::BASE_URL_API . $this->api_endpoint;
	}

	protected function send_error( $response ) {
		$error = (array) $response['ErrorDetails']->Message;
		wp_send_json_error( $error[0] );
	}

	protected function check_response( $response ) {
		if ( ! $response ) {
			wp_send_json_error( __( 'Error on client server. Check Request_Api log', 'rgbcode-authform' ) );
		}

		if ( isset( $response['error'] ) ) {
			$description   = $response['error'][0]['description'] ?? '';
			$error_log_msg = ' request_id[' . ( $response['requestId'] ?? '' ) . ']: ' . $description;
			Error::instance()->log_error( 'Panda_Api', $error_log_msg );
			wp_send_json_error( $description . ' (error code: {' . ( $response['requestId'] ?? '' ) . '})' );
		}
	}

}

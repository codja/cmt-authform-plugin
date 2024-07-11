<?php

namespace Rgbcode_authform\classes\providers\antelope;

use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\helpers\Request_Api;
use Rgbcode_authform\classes\providers\antelope\requests\Antelope_Register;
use Rgbcode_authform\interfaces\CRM_Endpoint;

class Antelope {

	public const BASE_URL_API = 'https://api.cmtrading.com/SignalsServer/api/';

	/**
	 * @var Antelope_Register
	 */
	public $register;

	public function __construct() {
		$this->register = new Antelope_Register();
	}

	public function get_headers(): array {
		return [
			'Content-Type' => 'application/json',
			'Accept'       => 'application/json',
		];
	}

	public function send_request( CRM_Endpoint $endpoint, array $data, $method = 'POST' ) {

		return Request_Api::send_api(
			$endpoint->get_endpoint() . '?' . http_build_query( $endpoint->get_body( $data ) ),
			[],
			'POST',
			$this->get_headers()
		);
	}

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

}

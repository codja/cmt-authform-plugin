<?php

namespace Rgbcode_authform\classes\providers\panda;

use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\helpers\Request_Api;
use Rgbcode_authform\classes\providers\panda\requests\Panda_Register;
use Rgbcode_authform\interfaces\CRM_Endpoint;

class Panda {

	public const BASE_URL_API = 'https://cmtrading.pandats-api.io/api/v3/';

	/**
	 * @var Panda_Register
	 */
	public $register;

	public function __construct() {
		$this->register = new Panda_Register();
	}

	public function get_headers(): array {

		return [
			'Authorization' => $this->get_auth_data(),
			'Content-Type'  => 'application/json',
		];
	}

	public function send_request( CRM_Endpoint $endpoint, array $data, $method = 'POST' ) {

		return Request_Api::send_api(
			$endpoint->get_endpoint(),
			wp_json_encode( $endpoint->get_body( $data ) ),
			$method,
			$this->get_headers()
		);
	}

	public function get_auth_data(): string {
		return 'Bearer ' . $this->get_jwt_token();
	}

	private function get_access_key(): string {
		return sha1( PANDA_PARTNER_ID . time() . PANDA_PARTNER_SECRET_KEY );
	}

	private function authorization() {
		$data = [
			'partnerId' => PANDA_PARTNER_ID,
			'time'      => time(),
			'accessKey' => $this->get_access_key(),
		];

		return Request_Api::send_api(
			self::BASE_URL_API . 'authorization',
			wp_json_encode( $data ),
			'POST',
			[
				'Content-Type' => 'application/json',
			]
		);
	}

	private function get_jwt_token() {
		$exist_token = get_option( 'panda_token' ) ? json_decode( get_option( 'panda_token' ), true ) : false;

		if ( $exist_token && $exist_token['expire'] > time() ) {
			return $exist_token['token'];
		}

		$authorization = $this->authorization();

		if ( ! $authorization ) {
			wp_send_json_error( __( 'Error on client server. Check Request_Api log', 'rgbcode-authform' ) );
		}

		if ( isset( $authorization['error'] ) ) {
			wp_send_json_error( $authorization['error'][0]['description'] );
		}

		$token_data = [
			'token'  => $authorization['data']['token'],
			'expire' => strtotime( $authorization['data']['expire'] ),
		];

		update_option( 'panda_token', wp_json_encode( $token_data ), false );

		return $token_data['token'];
	}

	public function check_response( $response ) {
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

	protected function send_error( $response ) {
		$error = (array) $response['ErrorDetails']->Message;
		wp_send_json_error( $error[0] );
	}

}

<?php

namespace Rgbcode_authform\classes\providers\antelope;

use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\helpers\Request_Api;
use Rgbcode_authform\classes\providers\antelope\requests\Antelope_Update;

/**
 * https://crm.cmtrading.com/#/documents/crm-api
 */
class Antelope_CRM extends Antelope {

	public const BASE_URL_API = 'https://apicrm.cmtrading.com/SignalsCRM/crm-api/';

	/**
	 * @var Antelope_Update
	 */
	public $update;

	public function __construct() {
		$this->update = new Antelope_Update();
	}

	/**
	 * @param $endpoint
	 * @param array $body
	 * @param $method
	 *
	 * @return false|mixed
	 */
	public function send_request( $endpoint, array $body, $method = 'POST', bool $body_query = false ) {
		if ( ! $endpoint || ! $body ) {
			return false;
		}

		$url      = $body_query ? $endpoint . '?' . http_build_query( $body ) : $endpoint;
		$body     = $body_query ? [] : wp_json_encode( $body );

		return Request_Api::send_api(
			$url,
			$body,
			$method,
			$this->get_headers()
		);
	}

	protected function get_headers(): array {
		$headers = parent::get_headers();

		$headers['x-crm-api-token'] = ANTILOPE_API_CRM_KEY;

		return $headers;
	}

	public function check_response( $response ) {
		if ( ! $response ) {
			wp_send_json_error( __( 'Error on client server. Check Request_Api log', 'rgbcode-authform' ) );
		}

		if ( isset( $response['error'] ) ) {
			if ( is_array( $response['error'] ) ) {
				parent::check_response( $response );
			}

			Error::instance()->log_error( 'Antelope_CRM', $response['error'] );
			wp_send_json_error( $response['error'] );
		}
	}

}

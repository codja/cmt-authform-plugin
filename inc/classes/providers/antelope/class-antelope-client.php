<?php

namespace Rgbcode_authform\classes\providers\antelope;

use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\helpers\Request_Api;

/**
 * https://crm.cmtrading.com/#/documents/client-api
 */
class Antelope_Client extends Antelope {

	public const BASE_URL_API = 'https://api.cmtrading.com/SignalsServer/client/api/';

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

		$base_url = self::BASE_URL_API . $endpoint;
		$url      = $body_query ? $base_url . '?' . http_build_query( $body ) : $base_url;
		$body     = $body_query ? [] : wp_json_encode( $body );

		return Request_Api::send_api(
			$url,
			$body,
			$method,
			$this->get_headers()
		);
	}

	public function check_response( $response ) {
		if ( ! $response ) {
			wp_send_json_error( __( 'Error on client server. Check Request_Api log', 'rgbcode-authform' ) );
		}

		if ( isset( $response['error'] ) ) {
			if ( is_array( $response['error'] ) ) {
				parent::check_response( $response );
			}

			Error::instance()->log_error( 'Antelope_Client', $response['error'] );
			wp_send_json_error( $response['error'] );
		}
	}

}

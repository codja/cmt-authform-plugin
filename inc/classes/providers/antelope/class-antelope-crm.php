<?php

namespace Rgbcode_authform\classes\providers\antelope;

use Rgbcode_authform\classes\helpers\Request_Api;
use Rgbcode_authform\interfaces\CRM_Endpoint;

/**
 * https://crm.cmtrading.com/#/documents/crm-api
 */
class Antelope_CRM extends Antelope {

	public const BASE_URL_API = 'https://apicrm.cmtrading.com/SignalsCRM/crm-api/';

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

	protected function get_headers(): array {
		$headers = parent::get_headers();

		$headers['x-crm-api-token'] = ANTILOPE_API_CRM_KEY;

		return $headers;
	}

}

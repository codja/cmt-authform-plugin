<?php

namespace Rgbcode_authform\classes\providers\antelope;

use Rgbcode_authform\classes\helpers\Request_Api;
use Rgbcode_authform\classes\providers\antelope\requests\Antelope_Login;
use Rgbcode_authform\classes\providers\antelope\requests\Antelope_Register;
use Rgbcode_authform\interfaces\CRM_Endpoint;

/**
 * https://crm.cmtrading.com/#/documents/affiliates-api
 */
class Antelope_Affiliate extends Antelope {

	public const BASE_URL_API = 'https://api.cmtrading.com/SignalsServer/api/';

	/**
	 * @var Antelope_Register
	 */
	public $register;

	/**
	 * @var Antelope_Login
	 */
	public $login;

	public function __construct() {
		$this->register = new Antelope_Register();
		$this->login    = new Antelope_Login();
	}

	public function send_request( CRM_Endpoint $endpoint, array $body = [], $method = 'POST' ) {

		return Request_Api::send_api(
			$endpoint->get_endpoint() . '?' . http_build_query( $body ),
			[],
			$method,
			$this->get_headers()
		);
	}

}

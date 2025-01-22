<?php

namespace Rgbcode_authform\classes\providers\antelope\requests;

use Rgbcode_authform\classes\providers\antelope\Antelope_Client;
use Rgbcode_authform\interfaces\CRM_Endpoint;

class Antelope_Login implements CRM_Endpoint {

	const REDIRECT_BASE_URL = 'https://myaccount.cmtrading.com/#/authentication/auth/';

	const DEFAULT_LINK = 'https://myaccount.cmtrading.com/#/login';

	public function get_result( $response, $request ): array {
		$link = ! empty( $response['result']['authToken'] )
			? self::REDIRECT_BASE_URL . $response['result']['authToken']
			: self::DEFAULT_LINK;

		return [
			'success' => $response['success'] ?? false,
			'link'    => $link,
		];
	}

	public function send_request( array $data, $provider ) {
		if ( ! $data ) {
			return null;
		}

		// get userid by email
		$api      = new Antelope_Client();
		$response = $api->send_request(
			$this->get_endpoint(),
			$this->get_body( $data ),
			'POST',
			true
		);
		$api->check_response( $response );

		return $response;
	}

	public function get_endpoint(): string {
		return 'users/authenticate';
	}

	public function get_body( $data ): array {
		return [
			'email'    => $data['email'] ?? '' ,
			'password' => $data['password'] ?? '',
		];
	}
}

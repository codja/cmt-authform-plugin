<?php

namespace Rgbcode_authform\classes\providers;

class Antelope {

	public const BASE_URL_API = 'https://api.cmtrading.com/SignalsServer/api/';

	public function get_endpoint_for_register(): string {
		return self::BASE_URL_API . 'registerUser';
	}

}

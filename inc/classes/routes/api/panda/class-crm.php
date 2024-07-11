<?php

namespace Rgbcode_authform\classes\routes\api\panda;

use Rgbcode_authform\classes\providers\panda\Panda;

abstract class CRM {

	protected $provider;

	public function __construct() {
		$this->provider = new Panda();
	}

}

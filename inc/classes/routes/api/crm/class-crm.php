<?php

namespace Rgbcode_authform\classes\routes\api\crm;

use Rgbcode_authform\classes\providers\antelope\Antelope_Affiliate;
use Rgbcode_authform\classes\providers\panda\Panda;

abstract class CRM {

	protected $provider;

	public function __construct() {
		$this->provider = new Antelope_Affiliate();
	}

}

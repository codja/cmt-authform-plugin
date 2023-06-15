<?php

namespace Rgbcode_authform\classes\routes\api\panda\customer;

use Rgbcode_authform\classes\routes\api\panda\Panda;

abstract class Customer extends Panda {

	protected $api_endpoint = 'customers';

	abstract protected function get_body( array $data ): array;

}

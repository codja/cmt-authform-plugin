<?php

namespace Rgbcode_authform\classes\authform\forms;

use Rgbcode_authform\classes\authform\Authform;

abstract class Baseform {

	const TEMPLATE_NAME = '';

	const ACTION = '';

	public function get_template_data(): array {
		return [];
	}
}

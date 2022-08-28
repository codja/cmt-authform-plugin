<?php

namespace Rgbcode_authform\classes\authform\forms;

abstract class Baseform {

	const TEMPLATE_NAME = '';

	public function get_template_data(): array {
		return [];
	}
}

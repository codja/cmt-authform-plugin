<?php

namespace Rgbcode_authform\classes\authform\forms;

use Rgbcode_authform\classes\authform\Authform;

abstract class Baseform {

	const TEMPLATE_NAME = '';

	const ACTION = '';

	public function get_template_data(): array {
		return [];
	}

	protected function get_visibility_class() : string {
		return isset( $_GET['action'] ) && $_GET['action'] === $this::ACTION // phpcs:ignore
			? ''
			: Authform::HIDE_CLASS;
	}
}

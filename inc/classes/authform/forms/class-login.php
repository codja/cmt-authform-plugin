<?php

namespace Rgbcode_authform\classes\authform\forms;

use Rgbcode_authform\classes\authform\Authform;
use Rgbcode_authform\traits\Singleton;

class Login extends Baseform {

	use Singleton;

	const TEMPLATE_NAME = 'login';

	const ACTION = 'forexLogin';

	public function get_template_data(): array {
		return [
			'logo'             => get_field( 'rgbc_authform_logo', 'option' ),
			'email'            => get_field( 'rgbc_authform_email', 'option' ),
			'pass'             => get_field( 'rgbc_authform_pass', 'option' ),
			'submit'           => get_field( 'rgbc_authform_submit', 'option' ),
			'visibility_class' => Authform::HIDE_CLASS,
		];
	}

	public static function render_login_btn( $atts = [] ): string {
		$id      = $atts['id'] ?? '';
		$classes = $atts['classes'] ?? '';
		$text    = $atts['text'] ?? '';

		return sprintf(
			'<button id="%s" class="js-rgbcode-authform js-login-btn %s" data-target="rgbcode-login">%s</button>',
			esc_attr( $id ),
			esc_attr( $classes ),
			esc_html( $text ),
		);
	}

}

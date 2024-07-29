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
			'title_block'      => get_field( 'rgbc_authform_login_title_block', 'option' ),
			'email'            => get_field( 'rgbc_authform_login_email', 'option' ),
			'pass'             => get_field( 'rgbc_authform_login_pass', 'option' ),
			'submit'           => get_field( 'rgbc_authform_login_submit', 'option' ),
			'visibility_class' => Authform::HIDE_CLASS,
		];
	}

	public function render_login_btn( $atts = [] ): string {
		return $this->shortcode_btn( 'login', $atts );
	}

}

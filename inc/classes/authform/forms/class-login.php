<?php

namespace Rgbcode_authform\classes\authform\forms;

use Rgbcode_authform\classes\authform\Authform;
use Rgbcode_authform\traits\Singleton;

class Login extends Baseform {

	use Singleton;

	const TEMPLATE_NAME = 'login';

	const SLUG = 'login';

	const ACTION = 'forexLogin';

	const TARGET = 'rgbcode-login';

	const SHORTCODE_TAG = 'authform-login';

	public function get_template_data(): array {
		return [
			'email'             => get_field( 'rgbc_authform_login_email', 'option' ),
			'pass'              => get_field( 'rgbc_authform_login_pass', 'option' ),
			'submit'            => get_field( 'rgbc_authform_login_submit', 'option' ),
			'forgot'            => get_field( 'rgbc_authform_login_forgot', 'option' ),
			'logo'              => get_field( 'rgbc_authform_logo', 'option' ),
			'bottom_login_link' => get_field( 'rgbc_authform_login_link', 'option' ),
			'visibility_class'  => Authform::HIDE_CLASS,
		];
	}

}

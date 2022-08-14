<?php

namespace Rgbcode_authform\classes\authform\forms;

use Rgbcode_authform\traits\Singleton;

class Sign_Up extends Baseform {

	use Singleton;

	const TEMPLATE_NAME = 'sign-up';

	public function get_template_data(): array {
		return [
			'title_block' => get_field( 'rgbc_authform_title_block', 'option' ),
			'full_name'   => get_field( 'rgbc_authform_full_name', 'option' ),
			'email'       => get_field( 'rgbc_authform_email', 'option' ),
			'phone'       => get_field( 'rgbc_authform_phone', 'option' ),
			'pass'        => get_field( 'rgbc_authform_pass', 'option' ),
			'terms'       => get_field( 'rgbc_authform_terms', 'option' ),
			'submit'      => get_field( 'rgbc_authform_submit', 'option' ),
			'message'     => get_field( 'rgbc_authform_message', 'option' ),
			'bottom_link' => get_field( 'rgbc_authform_link', 'option' ),
			'msgs'        => [
				'weak'   => 'Weak Password',
				'medium' => 'Medium Password',
				'strong' => 'Strong Password',
			],
		];
	}

}

<?php

namespace Rgbcode_authform\classes\authform\forms;

use Rgbcode_authform\classes\authform\Authform;
use Rgbcode_authform\classes\helpers\Location;
use Rgbcode_authform\traits\Singleton;

class Sign_Up extends Baseform {

	use Singleton;

	const TEMPLATE_NAME = 'sign-up';

	const ACTION = 'forexSignup';

	public function get_template_data(): array {
		return [
			'title_block'      => get_field( 'rgbc_authform_title_block', 'option' ),
			'first_name'       => get_field( 'rgbc_authform_first_name', 'option' ),
			'last_name'        => get_field( 'rgbc_authform_last_name', 'option' ),
			'email'            => get_field( 'rgbc_authform_email', 'option' ),
			'phone'            => get_field( 'rgbc_authform_phone', 'option' ),
			'pass'             => get_field( 'rgbc_authform_pass', 'option' ),
			'terms'            => get_field( 'rgbc_authform_terms', 'option' ),
			'submit'           => get_field( 'rgbc_authform_submit', 'option' ),
			'message'          => get_field( 'rgbc_authform_message', 'option' ),
			'bottom_link'      => get_field( 'rgbc_authform_link', 'option' ),
			'logo'             => get_field( 'rgbc_authform_logo', 'option' ),
			'visibility_class' => Authform::HIDE_CLASS,
			//          'msgs'             => [
			//              'weak'   => __( 'Weak Password', 'rgbcode-authform' ),
			//              'medium' => __( 'Medium Password', 'rgbcode-authform' ),
			//              'strong' => __( 'Strong Password', 'rgbcode-authform' ),
			//          ],
				'countries'    => Location::COUNTRIES,
			'default_country'  => Location::get_default_country(),
		];
	}

	public static function render_signup_btn( $atts = [] ): string {
		$id      = $atts['id'] ?? '';
		$classes = $atts['classes'] ?? '';
		$text    = $atts['text'] ?? '';

		return sprintf(
			'<button id="%s" class="js-rgbcode-authform %s" data-target="rgbcode-signup">%s</button>',
			esc_attr( $id ),
			esc_attr( $classes ),
			esc_html( $text ),
		);
	}

}

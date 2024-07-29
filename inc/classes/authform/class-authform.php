<?php

namespace Rgbcode_authform\classes\authform;

use Rgbcode_authform\classes\authform\forms\Login;
use Rgbcode_authform\classes\authform\forms\Sign_Up;
use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\traits\Singleton;

class Authform {

	use Singleton;

	const ACTIVE_FORMS = [
		'signup' => 'Sign_Up',
		'login'  => 'Login',
//		'deposit' => 'Deposit',
	];

	const HIDE_CLASS = 'rgbcode-hidden';

	public function __construct() {
		add_action( 'wp_footer', [ $this, 'render_forms' ] );
		add_shortcode( 'authform-signup', [ Sign_Up::instance(), 'render_signup_btn' ] );
		add_shortcode( 'authform-login', [ Login::instance(), 'render_login_btn' ] );
	}

	public function render_forms() {
		if ( ! Error::instance()->is_form_enabled() ) {
			return;
		}

		printf(
			'<div id="rgbcode-authform" class="rgbcode-authform-back %s">',
			esc_attr( self::HIDE_CLASS )
		);

		foreach ( $this->get_actual_forms() as $key => $form ) {
			$this->include_form( $form );
		}

		printf( '</div>' );
	}

	private function include_form( string $form ): void {
		$class = __NAMESPACE__ . '\\forms\\' . $form;
		$args  = $class::instance()->get_template_data();
		include_once RGBCODE_AUTHFORM_TEMPLATES . '/' . $class::TEMPLATE_NAME . '.php';
	}

	private function get_actual_forms(): array {
		return self::ACTIVE_FORMS;
	}
}

<?php

namespace Rgbcode_authform\classes\authform;

use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\traits\Singleton;

class Authform {

	use Singleton;

	const ACTIVE_FORMS = [
		'Sign_Up',
	//      'Login',
	];

	const ALLOW_ACTIONS = [
		'forexSignup',
//		'forexLogin',
	];

	const HIDE_CLASS = 'rgbcode-hidden';

	public function __construct() {
		add_action( 'wp_footer', [ $this, 'render_forms' ] );
	}

	public function render_forms() {
		if ( ! Error::instance()->is_form_enabled() ) {
			return;
		}

		printf(
			'<div id="rgbcode-authform" class="rgbcode-authform-back %s">',
			esc_attr( $this->check_actions() )
		);

		foreach ( self::ACTIVE_FORMS as $form ) {
			$this->include_form( $form );
		}

		printf( '</div>' );
	}

	private function include_form( string $form ): void {
		$class = __NAMESPACE__ . '\\forms\\' . $form;
		$args  = $class::instance()->get_template_data();
		include_once RGBCODE_AUTHFORM_TEMPLATES . '/' . $class::TEMPLATE_NAME . '.php';
	}

	private function check_actions(): string {
		if ( ! isset( $_GET['action'] ) ) { // phpcs:ignore
			return self::HIDE_CLASS;
		}

		return in_array( $_GET['action'], self::ALLOW_ACTIONS, true ) // phpcs:ignore
			? ''
			: self::HIDE_CLASS;
	}
}

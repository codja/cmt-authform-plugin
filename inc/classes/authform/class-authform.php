<?php

namespace Rgbcode_authform\classes\authform;

class Authform {

	const ACTIVE_FORMS = [
		'Sign_Up',
	//      'Login',
	];

	public function __construct() {
		add_action( 'wp_footer', [ $this, 'render_forms' ] );
	}

	public function render_forms() {
		echo '<button class="js-rgbcode-modal" data-target="rgbcode-signup">Modal</button>'; // TODO: remove it (only for dev)
		printf( '<div class="rgbcode-authform-back rgbcode-hidden">' );

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
}

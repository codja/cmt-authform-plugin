<?php

namespace Rgbcode_authform\classes\authform;

use Rgbcode_authform\classes\authform\forms\Sign_Up;
use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\Panda_DB;
use Rgbcode_authform\traits\Singleton;

class Authform {

	use Singleton;

	const ACTIVE_FORMS = [
		'signup'  => 'Sign_Up',
		'deposit' => 'Deposit',
	];

	const HIDE_CLASS = 'rgbcode-hidden';

	private $registered_user;

	public function __construct() {
		add_action( 'wp_footer', [ $this, 'render_forms' ] );
		add_shortcode( 'authform-signup', [ Sign_Up::class, 'render_signup_btn' ] );
		$this->registered_user = $this->check_register_user();
	}

	public function get_registered_user(): ?array {
		return $this->registered_user;
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
		$actual_forms = self::ACTIVE_FORMS;

		if ( $this->registered_user ) {
			unset( $actual_forms['signup'] );
		}

		return $actual_forms;
	}

	private function check_register_user(): ?array {
		$action_name = 'personDetailsForm';
		$client_id   = $_GET['clientid'] ?? null;
		$action      = $_GET['action'] ?? null;

		if ( ! $client_id || ! $action || $action !== $action_name ) {
			return null;
		}

		return Panda_DB::instance()->get_user_register_data(
			'customer_id',
			$client_id,
			'email, country, base_currency, birth_date, city, address, post_code'
		);
	}
}

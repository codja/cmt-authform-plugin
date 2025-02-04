<?php

namespace Rgbcode_authform\classes\authform;

use Rgbcode_authform\classes\authform\forms\Deposit;
use Rgbcode_authform\classes\authform\forms\Login;
use Rgbcode_authform\classes\authform\forms\Sign_Up;
use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\CRM_DB;
use Rgbcode_authform\traits\Singleton;

class Authform {

	use Singleton;

	const ACTIVE_FORMS = [
		'signup' => 'Sign_Up',
		'login'  => 'Login',
//		'deposit' => 'Deposit',
	];

	const HIDE_CLASS = 'rgbcode-hidden';

	const REDIRECT_LINK = 'https://myaccount.cmtrading.com/#/login';

	private $registered_user;

	public function __construct() {
		add_action( 'wp_footer', [ $this, 'render_forms' ] );
		add_shortcode( 'authform-signup', [ Sign_Up::instance(), 'render_signup_btn' ] );
		add_shortcode( 'authform-login', [ Login::instance(), 'render_login_btn' ] );
		add_shortcode( 'authform-deposit', [ Deposit::instance(), 'render_form' ] );
		$this->registered_user = $this->get_check_register_user();
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

//		if ( $this->registered_user ) {
//			unset( $actual_forms['signup'] );
//		}

		return $actual_forms;
	}

	/**
	 * Checks and retrieves user registration data based on provided parameters.
	 *
	 * @return array|null User data array if valid, null otherwise.
	 */
	public function get_check_register_user(): ?array {
		// Sanitize input parameters
		$email      = sanitize_email( $_GET['email'] ?? '' ); // phpcs:ignore
		$account_no = sanitize_text_field( $_GET['account_no'] ?? '' ); // phpcs:ignore

		// Validate email and account number
		if ( ! $email || ! $account_no ) {
			return null;
		}

		// Retrieve user registration data from the database
		$result = CRM_DB::instance()->get_user_register_data(
			'email',
			$email,
			'email, customer_id'
		);

		if ( empty( $result ) || ! is_array( $result ) ) {
			return null;
		}

		// Extract the customer ID from the result
		$db_customer_id = $result['customer_id'] ?? null;

		// Validate customer ID and account number match
		if ( ! $db_customer_id || ! $this->is_account_no_match( (string) $db_customer_id, $account_no ) ) {
			wp_redirect( self::REDIRECT_LINK );
			exit;
		}

		return $result;
	}

	/**
	 * Validates if the account number matches the user ID.
	 *
	 * @param string $user_id    The customer ID retrieved from the database.
	 * @param string $account_no The account number provided by the user.
	 *
	 * @return bool True if the IDs match, false otherwise.
	 */
	private function is_account_no_match( string $user_id, string $account_no ): bool {
		return $user_id === $account_no;
	}
}

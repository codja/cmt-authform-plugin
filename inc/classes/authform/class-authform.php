<?php

namespace Rgbcode_authform\classes\authform;

use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\helpers\Location;
use Rgbcode_authform\classes\Panda_DB;
use Rgbcode_authform\traits\Singleton;

class Authform {

	use Singleton;

	const ACTIVE_FORMS = [
		'signup'  => 'Sign_Up',
		'deposit' => 'Deposit',
		'login'   => 'Login',
	];

	const HIDE_CLASS = 'rgbcode-hidden';

	const AVAILABLE_LGS = [
		'en' => 'www',
		'ar' => 'ar',
		'es' => 'es',
	];

	const SECOND_STEP_ACTION_NAME = 'personDetailsForm';

	private $registered_user;

	public function __construct() {
		add_action( 'wp_footer', [ $this, 'render_forms' ] );
		$this->register_shortcodes();
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

		foreach ( $this->get_actual_forms() as $form ) {
			$this->include_form( $form );
		}

		printf( '</div>' );
	}

	private function include_form( string $form ): void {
		$class = $this->get_form_class_name( $form );

		if ( ! class_exists( $class ) ) {
			return;
		}

		$args = $class::instance()->get_template_data();
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
		$client_id = ! empty( $_GET['clientid'] ) ? sanitize_text_field( $_GET['clientid'] ) : null; //phpcs:ignore
		$action    = ! empty( $_GET['action'] ) ? sanitize_text_field( $_GET['action'] ) : null; //phpcs:ignore

		if ( ! $client_id || ! $action || $action !== self::SECOND_STEP_ACTION_NAME ) {
			return null;
		}

		$result = Panda_DB::instance()->get_user_register_data(
			'customer_id',
			$client_id,
			'email, country, base_currency, birth_date, city, address, post_code'
		);

		if ( ! $result ) {
			return null;
		}

		$authform_lg  = get_field( 'rgbc_authform_lang', 'option' );
		$requested_lg = ! empty( $_GET['lg'] ) ? sanitize_text_field( $_GET['lg'] ) : null; //phpcs:ignore
		if ( $requested_lg && key_exists( $requested_lg, self::AVAILABLE_LGS ) && $authform_lg !== $requested_lg ) {
			$url_for_redirect = 'https://' . self::AVAILABLE_LGS[ $requested_lg ] . '.cmtrading.com' . add_query_arg();
			wp_redirect( $url_for_redirect ); //phpcs:ignore
			exit();
		}

		$result['iso'] = Location::get_iso_by_country_name( $result['country'] );

		return $result;
	}

	private function register_shortcodes() {
		foreach ( self::ACTIVE_FORMS as $form_class ) {
			$class = $this->get_form_class_name( $form_class );

			if ( ! class_exists( $class ) ) {
				continue;
			}

			add_shortcode( $class::SHORTCODE_TAG, [ $class, 'render_btn' ] );
		}
	}

	private function get_form_class_name( string $name ): ?string {
		if ( ! $name ) {
			return null;
		}

		return __NAMESPACE__ . '\\forms\\' . $name;
	}
}

<?php

namespace Rgbcode_authform\classes;

use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\helpers\Authorization;
use Rgbcode_authform\classes\helpers\Request_Api;

class Endpoint {

	const ENDPOINTS = [
		'autologin'     => 'account_no',
		'autologin_new' => 'customer_id',
	];

	protected $auth;

	public function __construct() {
		$this->auth = new Authorization();
		add_action( 'template_redirect', [ $this, 'autologin' ] );
	}

	public function autologin() {
		if ( ! Error::instance()->is_defined_constants() ) {
			return;
		}

		$url = trim(
			wp_parse_url( $_SERVER['REQUEST_URI'] )['path'],
			'/'
		);

		if ( ! array_key_exists( $url, self::ENDPOINTS ) ) {
			return;
		}

		$error_redirect = '/webtrader/?action=forexLogin';

		$email           = sanitize_email( $_GET['emailaddress'] ?? '' );
		$account_no      = sanitize_text_field( $_GET['account_no'] ?? '' );
		$action          = sanitize_text_field( $_GET['action'] ?? '' );
		$user_registered = Panda_DB::instance()->get_user_register_data( 'email', $email, self::ENDPOINTS[ $url ] );

		if ( is_null( $user_registered ) || ! $this->is_account_no_match( $user_registered[ self::ENDPOINTS[ $url ] ], $account_no ) ) {
			wp_safe_redirect( $error_redirect );
			exit;
		}

		$response = Request_Api::send_api(
			$this->auth::BASE_URL_API . 'system/loginToken',
			wp_json_encode(
				[
					'email' => $email,
				]
			),
			'POST',
			[
				'Authorization' => $this->auth->get_auth_data(),
				'Content-Type'  => 'application/json',
			]
		);

		if ( ! $response ) {
			wp_safe_redirect( $error_redirect );
			exit;
		}

		if ( isset( $response['error'] ) ) {
			Error::instance()->log_error( 'class-endpoint-error', $response['error'][0]['description'] );
		}

		$link_for_redirect = Request_Api::get_response_link(
			$response['data']['url'] ?? '',
			'action',
			true,
			$action
		);

		wp_safe_redirect( $link_for_redirect );
		exit;
	}

	private function is_dates_match( string $user_registered, string $registration_date ): bool {
		if ( ! $user_registered || ! $registration_date ) {
			return false;
		}

		$date_without_time = explode( ' ', $user_registered, 2 );
		return reset( $date_without_time ) === $registration_date;
	}

	private function is_account_no_match( string $user_registered, string $account_no ): bool {
		if ( ! $user_registered || ! $account_no ) {
			return false;
		}

		return $user_registered === $account_no;
	}
}

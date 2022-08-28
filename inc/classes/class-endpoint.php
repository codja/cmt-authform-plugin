<?php

namespace Rgbcode_authform\classes;

use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\helpers\Authorization;
use Rgbcode_authform\classes\helpers\Request_Api;

class Endpoint {

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

		if ( $url !== 'autologin' ) {
			return;
		}

		$email             = sanitize_email( $_GET['emailaddress'] ?? '' );
		$registration_date = sanitize_text_field( $_GET['registration_date'] ?? '' );
		$partner_id        = sanitize_text_field( $_GET['partner_id'] ?? '' );
		$action            = sanitize_text_field( $_GET['action'] ?? '' );

		$user              = get_user_by( 'email', $email );
		$user_registered   = strtotime( $user->user_registered );
		$registration_date = $registration_date ? strtotime( $registration_date . ' -3 hours +2 seconds' ) : 0;
		$error_redirect    = '/webtrader/?action=forexLogin';

		if ( $user_registered !== $registration_date || ! $email ) {
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
}

<?php

namespace Rgbcode_authform\classes;

use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\helpers\Authorization;
use Rgbcode_authform\classes\helpers\Request_Api;

class Endpoint {

	protected $auth;

	public function __construct() {
		$this->auth = new Authorization();
		add_action( 'init', [ $this, 'autologin' ] );
	}

	public function autologin() {
		$url               = trim(
			wp_parse_url( $_SERVER['REQUEST_URI'] )['path'],
			'/'
		);
		$email             = sanitize_email( $_GET['emailaddress'] ?? '' );
		$registration_date = sanitize_text_field( $_GET['registration_date'] ?? '' );

		if ( $url !== 'autologin'
			|| ! $email
			|| ! $registration_date
		) {
			return;
		}
		$user            = get_user_by( 'email', $email );
		$user_registered = $user->user_registered;
		$partner_id      = sanitize_text_field( $_GET['partner_id'] ?? '' );

		if ( $user_registered !== $registration_date ) {
			return;
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
			return;
		}

		if ( isset( $response['error'] ) ) {
			Error::instance()->log_error( 'class-endpoint-error', $response['error'][0]['description'] );
		}

		$link_for_redirect = Request_Api::get_response_link( $response['data']['url'] ?? '', 'action' );

		wp_safe_redirect( $link_for_redirect );
		exit;
	}
}

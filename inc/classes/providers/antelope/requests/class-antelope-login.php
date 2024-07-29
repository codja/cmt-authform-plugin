<?php

namespace Rgbcode_authform\classes\providers\antelope\requests;

use Rgbcode_authform\classes\providers\antelope\Antelope_Affiliate;
use Rgbcode_authform\classes\providers\antelope\Antelope_CRM;
use Rgbcode_authform\interfaces\CRM_Endpoint;

class Antelope_Login implements CRM_Endpoint {

	public function get_endpoint(): string {
		return Antelope_Affiliate::BASE_URL_API . 'getUser';
	}

	public function get_body( $data ): array {

		return [
			'userid' => absint( $data['user_id'] ?? '' ),
			'apikey' => ANTILOPE_API_AFFILIATE_KEY,
		];
	}

	public function get_result( $response, $request ): array {

		return [
			'success' => $response['success'] ?? false,
			'link'    => $response['result'] ?? '',
		];
	}

	public function send_request( array $data, $provider ) {
		if ( ! $data ) {
			return null;
		}

		// get userid by email
		$antelope_crm = new Antelope_CRM();
		$response     = $antelope_crm->send_request(
			'user-id',
			[
				'email' => $data['email'] ?? '',
			]
		);
		$antelope_crm->check_response( $response );

		// get userdata from CRM
		$user_id   = $response['result'] ?? null;
		$user_data = $provider->send_request(
			$this,
			$this->get_body( [ 'user_id' => $user_id ] )
		);
		$provider->check_response( $user_data );

		// checking password
		$password_hash = $user_data['result']['password'] ?? null;
		$user_password = $data['password'] ?? '';
		if ( ! password_verify( $user_password, $password_hash ) ) {
			wp_send_json_error( esc_html__( 'Incorrect Data', 'rgbcode-authform' ) );
		}

		// get autologin link(regenerated)
		$regenerate_autologin = new Regenerate_Autologin();
		$regenerate_data      = $provider->send_request(
			$regenerate_autologin,
			$regenerate_autologin->get_body( [ 'user_id' => $user_id ] )
		);
		$provider->check_response( $regenerate_data );

		return $regenerate_data;
	}

}

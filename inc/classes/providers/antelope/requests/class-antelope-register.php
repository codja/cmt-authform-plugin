<?php

namespace Rgbcode_authform\classes\providers\antelope\requests;

use Rgbcode_authform\classes\providers\antelope\Antelope;
use Rgbcode_authform\interfaces\CRM_Endpoint;

class Antelope_Register implements CRM_Endpoint {

	public function get_endpoint(): string {
		return Antelope::BASE_URL_API . 'registerUser';
	}

	public function get_body( $data ): array {
		$body = [
			'firstname'  => sanitize_text_field( $data['firstname'] ?? '' ),
			'lastname'   => sanitize_text_field( $data['lastname'] ?? '' ),
			'email'      => sanitize_email( $data['email'] ?? '' ),
			'telephone'  => sanitize_text_field( ( $data['phonecountry'] ?? '' ) . ( $data['phone'] ?? '' ) ),
			'countryiso' => sanitize_text_field( $data['iso'] ?? '' ),
			'password'   => sanitize_text_field( $data['password'] ?? '' ),
			'apikey'     => ANTILOPE_API_KEY,
		];

		if ( ! empty( $data['referral']['referral'] ) ) {
			$body['referral'] = sanitize_text_field( $data['referral']['referral'] );
		}

		return $body;
	}

	public function get_result( $response, $request ): array {
		return [
			'success' => 'ok' === $response['data']['status'],
			'email'   => sanitize_email( $request->get_param( 'email' ) ),
		];
	}

}

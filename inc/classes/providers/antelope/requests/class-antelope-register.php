<?php

namespace Rgbcode_authform\classes\providers\antelope\requests;

use Rgbcode_authform\classes\providers\antelope\Antelope_Affiliate;
use Rgbcode_authform\interfaces\CRM_Endpoint;

class Antelope_Register implements CRM_Endpoint {

	public function get_endpoint(): string {
		return Antelope_Affiliate::BASE_URL_API . 'registerUser';
	}

	public function get_body( $data ): array {
		$body = [
			'firstname'  => sanitize_text_field( $data['firstname'] ?? '' ),
			'lastname'   => sanitize_text_field( $data['lastname'] ?? '' ),
			'email'      => sanitize_email( $data['email'] ?? '' ),
			'telephone'  => sanitize_text_field( ( $data['phonecountry'] ?? '' ) . ( $data['phone'] ?? '' ) ),
			'countryiso' => sanitize_text_field( $data['iso'] ?? '' ),
			'password'   => sanitize_text_field( $data['password'] ?? '' ),
			'apikey'     => ANTILOPE_API_AFFILIATE_KEY,
		];

		if ( ! empty( $data['referral']['referral'] ) ) {
			$body['referral'] = sanitize_text_field( $data['referral']['referral'] );
		}

		if ( ! empty( $data['referral']['clientSource'] ) ) {
			$body['sc'] = sanitize_text_field( $data['referral']['clientSource'] );
		}

		return $body;
	}

	public function get_result( $response, $request ): array {

		return [
			'success' => $response['success'] ?? false,
			'link'    => $response['result']['brokerLoginUrl'] ?? '',
		];
	}

}

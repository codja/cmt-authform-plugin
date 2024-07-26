<?php

namespace Rgbcode_authform\classes\providers\panda\requests;

use Rgbcode_authform\classes\providers\panda\Panda;
use Rgbcode_authform\interfaces\CRM_Endpoint;

class Panda_Register implements CRM_Endpoint {

	public function get_endpoint(): string {
		return Panda::BASE_URL_API . 'customers';
	}

	public function get_body( $data ): array {
		$body = [
			'email'                    => sanitize_email( $data['email'] ?? '' ),
			'country'                  => sanitize_text_field( $data['iso'] ?? '' ),
			'firstName'                => sanitize_text_field( $data['firstname'] ?? '' ),
			'lastName'                 => sanitize_text_field( $data['lastname'] ?? '' ),
			'phone'                    => sanitize_text_field( ( $data['phonecountry'] ?? '' ) . ( $data['phone'] ?? '' ) ),
			'password'                 => sanitize_text_field( $data['password'] ?? '' ),
			'acceptTermsAndConditions' => $data['agree'] ?? false,
			'language'                 => $data['lang'] ?? 'enu',
		];

		if ( ! empty( $data['referral']['referral'] ) ) {
			$body['referral'] = sanitize_text_field( $data['referral']['referral'] );
		}

		if ( ! empty( $data['referral']['clientSource'] ) ) {
			$body['clientSource'] = sanitize_text_field( $data['referral']['clientSource'] );
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

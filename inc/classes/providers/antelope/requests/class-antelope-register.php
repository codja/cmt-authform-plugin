<?php

namespace Rgbcode_authform\classes\providers\antelope\requests;

use Rgbcode_authform\classes\providers\antelope\Antelope_Affiliate;
use Rgbcode_authform\interfaces\CRM_Endpoint;

class Antelope_Register implements CRM_Endpoint {

	const REFERRAL_PARAMS = [
		'referral'           => 'referral',
		'sc'                 => 'clientSource',
		'trackingcampaignId' => 'campaignCode',
		'p6'                 => 'p6',
	];

	public function get_endpoint(): string {
		return Antelope_Affiliate::BASE_URL_API . 'registerUser';
	}

	public function get_body( $data ): array {
		$body = [
			'firstname'   => sanitize_text_field( $data['firstname'] ?? '' ),
			'lastname'    => sanitize_text_field( $data['lastname'] ?? '' ),
			'email'       => sanitize_email( $data['email'] ?? '' ),
			'telephone'   => sanitize_text_field( ( $data['phonecountry'] ?? '' ) . ( $data['phone'] ?? '' ) ),
			'countryiso'  => sanitize_text_field( $data['iso'] ?? '' ),
			'languageiso' => sanitize_text_field( $data['language'] ?? '' ),
			'password'    => sanitize_text_field( $data['password'] ?? '' ),
			'apikey'      => ANTILOPE_API_AFFILIATE_KEY,
		];

		foreach ( self::REFERRAL_PARAMS as $param => $key ) {
			if ( ! empty( $data['referral'][ $key ] ) ) {
				$body[ $param ] = sanitize_text_field( $data['referral'][ $key ] );
			}
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

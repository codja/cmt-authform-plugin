<?php

namespace Rgbcode_authform\classes\providers\antelope\requests;

use Rgbcode_authform\classes\CRM_DB;
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
		$email = $request->get_param( 'email' );
		if ( empty( $email ) ) {
			return [
				'success' => false,
				'link'    => '',
			];
		}

		$email      = sanitize_email( $email );
		$user_data  = CRM_DB::instance()->get_user_register_data( 'email', $email, 'customer_id' );
		$account_no = $user_data['customer_id'] ?? '';

		$redirect_link = get_field( 'rgbc_authform_deposit_form_url', 'option' ) ?? '';
		if ( ! empty( $redirect_link ) && ! empty( $account_no ) ) {
			$redirect_link = add_query_arg(
				[
					'email'      => $email,
					'account_no' => $account_no,
				],
				$redirect_link
			);
		} else {
			$redirect_link = $response['result']['brokerLoginUrl'] ?? '';
		}

		return [
			'success' => $response['success'] ?? false,
			'link'    => esc_url_raw( $redirect_link ),
		];
	}

}

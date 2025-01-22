<?php

namespace Rgbcode_authform\classes\providers\antelope\requests;


use Rgbcode_authform\classes\providers\antelope\Antelope_CRM;
use Rgbcode_authform\interfaces\CRM_Endpoint;

class Antelope_Update implements CRM_Endpoint {

	public function get_endpoint(): string {
		return Antelope_CRM::BASE_URL_API . 'user';
	}

	public function get_body( $data ): array {
		$city    = sanitize_text_field( trim( $data['city'] ?? '' ) );
		$address = sanitize_text_field( trim( $data['address'] ?? '' ) );
		$poBox   = sanitize_text_field( trim( $data['postcode'] ?? '' ) );

		return [
			'id'          => absint( $data['account_id'] ?? 0 ),
			'city'        => $city,
			'address'     => $address,
			'fullAddress' => trim("$city $address $poBox"),
			'poBox'       => $poBox,
			'dateOfBirth' => $this->convert_date( $data['birthday'] ?? '' ),
		];
	}

	public function get_result( $response, $request ): array {

		return [
			'success' => $response['success'] ?? false,
			'link'    => '',
		];
	}

	/*
	 * Expected incoming format DD/MM/YYY
	 * Convert date to format YYYY-MM-DD
	*/
	private function convert_date( string $date ): ?string {
		if ( ! $date ) {
			return null;
		}

		$date = sanitize_text_field( $date );
		$date = explode( '/', $date );

		if ( ! $date || empty( $date[0] ) || empty( $date[1] ) || empty( $date[2] ) ) {
			wp_send_json_error( __( 'Error with date (birthday) format', 'rgbcode-authform' ) );
		}

		$date = "{$date[2]}/{$date[1]}/{$date[0]}";

		return wp_date( 'Y-m-d', strtotime( $date ) );
	}
}

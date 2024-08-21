<?php

namespace Rgbcode_authform\classes\routes\api\crm\customer;

use Rgbcode_authform\classes\routes\api\crm\CRM;
use Rgbcode_authform\classes\routes\Routes;

class Customer_Create extends CRM {

	public function post( \WP_REST_Request $request ) {
		Routes::check_nonce( $request );

		$data     = $request->get_params();
		$response = $this->provider->send_request( $this->provider->register, $this->get_body( $data ) );

		$this->provider->check_response( $response );
		$result = $this->provider->register->get_result( $response, $request );

		/**
		 * Fires after registration user in the Panda.
		 *
		 * @date    28/01/24
		 *
		 * @param  array $result.
		 */
		do_action( 'authform_after_register', $result );

		wp_send_json( $result );
	}

	protected function get_body( array $data ): array {
		$data['agree']    = $this->get_tcc_checked( sanitize_text_field( $data['agree'] ?? '' ) );
		$data['lang']     = $this->get_site_language();
		$data['referral'] = $this->extract_referral_data( $data );

		$result = $this->provider->register->get_body( $data );

		/**
		 * Filter for registration parameters.
		 *
		 * @date    28/01/24
		 *
		 * @param   array $result The result.
		 */
		return apply_filters( 'authform_params_for_register', $result );
	}

	private function get_site_language(): ?string {
		$language = get_field( 'rgbc_authform_lang', 'option' );

		if ( ! $language ) {
			return 'enu';
		}

		$convert = [
			'en' => 'enu',
			'ar' => 'ara',
			'es' => 'spa',
		];

		return $convert[ $language ] ?? 'enu';
	}

	private function get_tcc_checked( string $agree ): bool {
		return $agree === 'on';
	}

	private function extract_referral_data( array $data ): ?array {
		$referral_src = sanitize_text_field( $data['referral'] ?? '' );
		$cid          = sanitize_text_field( $data['cid'] ?? '' );

		if ( ! $referral_src ) {
			return null;
		}

		// Decode the URL-encoded 'referral' string and split it into key-value pairs
		$referral_src = urldecode( $referral_src );
		$referral_arr = explode( '|', $referral_src );

		// Initialize an array to store the parsed referral data
		$referral_data = [];
		foreach ( $referral_arr as $item ) {
			$param = explode( '=', $item );

			// Only add valid key-value pairs to the referral data array
			if ( ! empty( $param[0] && ! empty( $param[1] ) ) ) {
				$referral_data[ $param[0] ] = $param[1] ?? '';
			}
		}

		// Add the 'cid' to the referral data if it exists
		if ( $cid ) {
			$referral_data['cid'] = $cid;
		}

		// Extract and remove 'clientSource' from referral data
		$client_source = $referral_data['clientSource'] ?? '';
		if ( isset( $referral_data['clientSource'] ) ) {
			unset( $referral_data['clientSource'] );
		}

		// Extract 'campaign_code' from referral data
		$campaign_code = $referral_data['campaign_code'] ?? '';
		$p6            = $referral_data['p6'] ?? '';

		// Rebuild the 'referral' string from the remaining referral data
		$referral_back = [];
		foreach ( $referral_data as $key => $value ) {
			$referral_back[] = "$key=$value";
		}
		$referral = implode( '|', $referral_back );

		return [
			'clientSource' => $client_source,
			'campaignCode' => $campaign_code,
			'p6'           => $p6,
			'referral'     => $referral,
		];
	}

}

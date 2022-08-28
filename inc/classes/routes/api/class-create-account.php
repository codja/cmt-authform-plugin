<?php

namespace Rgbcode_authform\classes\routes\api;

class Create_Account extends Base_Route {

	protected $api_endpoint = 'customers';

	protected function get_body( array $data ): array {
		$body                             = parent::get_body( $data );
		$body['password']                 = sanitize_text_field( $data['password'] );
		$body['acceptTermsAndConditions'] = $this->get_tcc_checked( sanitize_text_field( $data['agree'] ) );

		return $body;
	}

	private function get_tcc_checked( string $agree ): bool {
		return $agree === 'on';
	}

}

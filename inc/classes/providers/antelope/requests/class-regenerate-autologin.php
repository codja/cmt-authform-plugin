<?php

namespace Rgbcode_authform\classes\providers\antelope\requests;

use Rgbcode_authform\interfaces\CRM_Endpoint;

class Regenerate_Autologin implements CRM_Endpoint {

	public function get_endpoint(): string {
		return 'regenerateUserAutologinUrl';
	}

	public function get_body( $data ): array {

		return [
			'userId' => absint( $data['user_id'] ?? '' ),
		];
	}

}

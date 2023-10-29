<?php

namespace Rgbcode_authform\classes\ajax;

use Rgbcode_authform\classes\ajax\requests\Nonce;

class Ajax {
	public function __construct() {

		$nonce = new Nonce();
		add_action(
			'wp_ajax_authform_get_refreshed_nonce',
			[ $nonce, 'refresh' ]
		);

		add_action(
			'wp_ajax_nopriv_authform_get_refreshed_nonce',
			[ $nonce, 'refresh' ]
		);

	}

}

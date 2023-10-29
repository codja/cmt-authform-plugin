<?php

namespace Rgbcode_authform\classes\ajax\requests;

class Nonce {
	public function refresh() {
		wp_send_json_success(
			[
				'nonce' => wp_create_nonce( 'wp_rest' ),
			]
		);
	}

}

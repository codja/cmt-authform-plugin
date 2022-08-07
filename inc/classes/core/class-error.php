<?php

namespace Rgbcode_authform\classes\core;

use Rgbcode_authform\traits\Singleton;

class Error {

	use Singleton;

	public function log_error( string $title, string $error ) {
		error_log(
			'[' . gmdate( 'Y-m-d H:i:s' ) . '] Error: {' . $title . ':' . $error . "} \n===========\n",
			3,
			RGBCODE_AUTHFORM_PLUGIN_DIR . 'errors.log'
		);
	}
}

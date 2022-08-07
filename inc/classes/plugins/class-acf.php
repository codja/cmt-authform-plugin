<?php

namespace Rgbcode_authform\classes\plugins;

use Rgbcode_authform\traits\Singleton;

class ACF {

	use Singleton;

	public function __construct() {
		//      in this hook you need register your fields
		//      https://www.advancedcustomfields.com/resources/register-fields-via-php/
		add_action( 'init', [ $this, 'register_fields' ] );

		// add new location

	}

	public function register_fields() {
		// phpcs:disable
		if ( function_exists('acf_add_local_field_group') ):

		endif;
		// phpcs:enable
	}
}

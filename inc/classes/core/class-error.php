<?php

namespace Rgbcode_authform\classes\core;

use Rgbcode_authform\traits\Singleton;

class Error {

	use Singleton;

	public function __construct() {
		add_action( 'admin_notices', [ $this, 'notice_required_settings' ] );
	}

	public function log_error( string $title, string $error ) {
		error_log(
			'[' . gmdate( 'Y-m-d H:i:s' ) . '] Error: {' . $title . ':' . $error . "} \n===========\n",
			3,
			RGBCODE_AUTHFORM_PLUGIN_DIR . 'errors.log'
		);
	}

	public function notice_required_settings() {
		if ( ! $this->is_defined_constants() ) {
			printf(
				'<div class="notice notice-error"><h3>%s</h3><p>%s</p></div>',
				esc_html( 'Rgbcode Authform:' ),
				esc_html__( 'You need add constants ANTILOPE_API_CRM_KEY and ANTILOPE_API_AFFILIATE_KEY in wp_config.', 'rgbcode-authform' ),
			);
		}
	}

	public function is_defined_constants(): bool {
//		return defined( 'PANDA_PARTNER_ID' ) && defined( 'PANDA_PARTNER_SECRET_KEY' );
		return defined( 'ANTILOPE_API_CRM_KEY' ) && defined( 'ANTILOPE_API_AFFILIATE_KEY' );
	}

	public function is_form_enabled(): bool {
		$enable = get_field( 'rgbc_authform_enable', 'option' );
		$enable = ! is_null( $enable ) ? $enable : false;
		return $enable && $this->is_defined_constants();
	}
}

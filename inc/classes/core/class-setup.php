<?php

namespace Rgbcode_authform\classes\core;

class Setup {

	public function __construct() {
		// Load our frontend css and js
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_front' ], 9000 );
	}

	public function enqueue_admin() {
		wp_enqueue_style(
			'rgbcode_authform_style_admin',
			RGBCODE_AUTHFORM_PLUGIN_URL . 'assets/css/admin/rgbcode-authform.min.css',
			[],
			filemtime( RGBCODE_AUTHFORM_PLUGIN_DIR . 'assets/css/admin/rgbcode-authform.min.css' )
		);
		wp_enqueue_script(
			'rgbcode_authform_script_admin',
			RGBCODE_AUTHFORM_PLUGIN_URL . 'assets/js/admin/rgbcode-authform.min.js',
			[],
			filemtime( RGBCODE_AUTHFORM_PLUGIN_DIR . 'assets/js/admin/rgbcode-authform.min.js' ),
			true
		);
	}

	public function enqueue_front() {
		wp_enqueue_style(
			'rgbcode_authform_style',
			RGBCODE_AUTHFORM_PLUGIN_URL . 'assets/css/front/rgbcode-authform.min.css',
			[],
			filemtime( RGBCODE_AUTHFORM_PLUGIN_DIR . 'assets/css/front/rgbcode-authform.min.css' )
		);
		wp_enqueue_script(
			'rgbcode_authform_script',
			RGBCODE_AUTHFORM_PLUGIN_URL . 'assets/js/front/rgbcode-authform.min.js',
			[],
			filemtime( RGBCODE_AUTHFORM_PLUGIN_DIR . 'assets/js/front/rgbcode-authform.min.js' ),
			true
		);

		// Localize our ajax
		wp_localize_script(
			'rgbcode_authform_script',
			'rgbcode_authform_ajax',
			[
				'url'   => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'rgbcode-authform-nonce' ),
			]
		);
	}
}

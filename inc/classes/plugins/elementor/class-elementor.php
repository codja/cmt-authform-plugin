<?php

namespace Rgbcode_authform\classes\plugins\elementor;

use Rgbcode_authform\classes\plugins\elementor\widgets\Simple_Form;

final class Elementor {

	public function __construct() {
		// Init Plugin
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}

		$this->add_actions();
	}

	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Simple_Form() );
	}

	private function add_actions() {
//		add_action( 'elementor/elements/categories_registered', [ $this, 'register_category' ] );
//		add_action( 'elementor/controls/controls_registered', [ $this, 'register_controls' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}

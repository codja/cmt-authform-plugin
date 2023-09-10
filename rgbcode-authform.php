<?php
/**
* Plugin Name: Rgbcode Authform
* Plugin URI: https://rgbcode.com/
* Description: Forms for registering and login in panda.
* Author: rgbcode
* Author URI: https://rgbcode.com/
* Version: 1.0.0
* Text Domain: rgbcode-authform
* Domain Path: /languages
*/

namespace Rgbcode_authform;

use Rgbcode_authform\classes\authform\Authform;
use Rgbcode_authform\classes\core\Error;
use Rgbcode_authform\classes\core\Setup;
use Rgbcode_authform\classes\Endpoint;
use Rgbcode_authform\classes\plugins\ACF;
use Rgbcode_authform\classes\plugins\elementor\Elementor;
use Rgbcode_authform\classes\routes\Routes;
use Rgbcode_authform\traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ( ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
		exit();
	}
}

define( 'RGBCODE_AUTHFORM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'RGBCODE_AUTHFORM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'RGBCODE_AUTHFORM_VERSION', '1.0.0' );
define( 'RGBCODE_AUTHFORM_IMAGES', RGBCODE_AUTHFORM_PLUGIN_URL . 'assets/img' );
define( 'RGBCODE_AUTHFORM_TEMPLATES', RGBCODE_AUTHFORM_PLUGIN_DIR . 'templates' );
define( 'RGBCODE_AUTHFORM_PARTIALS', RGBCODE_AUTHFORM_PLUGIN_DIR . 'partials' );
define( 'RGBCODE_AUTHFORM_IMAGES_DIR', RGBCODE_AUTHFORM_PLUGIN_DIR . 'assets/img' );

require_once RGBCODE_AUTHFORM_PLUGIN_DIR . 'inc/autoload.php';
require_once RGBCODE_AUTHFORM_PLUGIN_DIR . 'inc/functions.php';

register_activation_hook( __FILE__, [ __NAMESPACE__ . '\\Rgbcode_authform', 'activation' ] );
register_deactivation_hook( __FILE__, [ __NAMESPACE__ . '\\Rgbcode_authform', 'deactivation' ] );
register_uninstall_hook( __FILE__, [ __NAMESPACE__ . '\\Rgbcode_authform', 'uninstall' ] );

add_action( 'plugins_loaded', [ __NAMESPACE__ . '\\Rgbcode_authform', 'instance' ] );

final class Rgbcode_Authform {

	use Singleton;

	public function __construct() {
		Error::instance();
		ACF::instance();
		new Elementor();
		new Setup();
		new Authform();
		new Routes();
		new Endpoint();

		load_plugin_textdomain(
			'rgbcode-authform',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages/'
		);
	}

	/*
	 * Plugin activation actions
	*/
	public static function activation(): void {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$plugin = $_REQUEST['plugin'] ?? ''; // phpcs:ignore
		check_admin_referer( "activate-plugin_{$plugin}" );

		flush_rewrite_rules();
	}

	/*
	 * Plugin deactivation actions
	*/
	public static function deactivation(): void {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$plugin = $_REQUEST['plugin'] ?? ''; // phpcs:ignore
		check_admin_referer( "deactivate-plugin_{$plugin}" );

		flush_rewrite_rules();
	}

	/*
	 * Plugin uninstall actions
	*/
	public static function uninstall(): void {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		self::remove_options();
	}

	/*
	 * Delete all options that the plugin has created
	*/
	private static function remove_options(): void {
		$options = [];

		foreach ( $options as $option ) {
			delete_option( $option );
		}
	}
}

<?php
/**
 * Plugin Name: Rgbcode Register Form
 * Plugin URI: https://rgbcode.com/
 * Description: Rgbcode Register Form.
 * Author: rgbcode
 * Author URI: https://rgbcode.com/
 * Version: 1.0.0
 * Text Domain: rgbcode-register-plugin
 * Domain Path: /languages
 */

function rgbc_register_plugin_menu() {
	add_menu_page(
		'RGBC Register Plugin',
		'RGBC Register Plugin',
		'manage_options',
		'rgbc-register-plugin',
		'display_top_level_menu_page',
		'',
		6
	);
}

add_action( 'admin_menu', 'rgbc_register_plugin_menu' );

function display_top_level_menu_page() {
	include( plugin_dir_path( __FILE__ ) . 'templates/dashboard-settings.php' );
}

if ( ! function_exists( 'rgbc_register_form' ) ) {
	function rgbc_register_form() {
		ob_start();
		include( plugin_dir_path( __FILE__ ) . '/templates/register-form.php' );

		return ob_get_clean();
	}

	add_shortcode( 'rgbc-register-form', 'rgbc_register_form' );
}

function rgbc_scripts() {
	wp_register_style( 'style-front', plugins_url( 'rgbc-register-plugin/assets/css/front/style.min.css' ) );
	wp_enqueue_style( 'style-front' );
}

add_action( 'wp_enqueue_scripts', 'rgbc_scripts' );

define( 'MY_ACF_PATH', plugin_dir_path( __FILE__ ) . '/includes/acf/' );
define( 'MY_ACF_URL', plugin_dir_path( __FILE__ ) . '/includes/acf/' );

include_once( MY_ACF_PATH . 'acf.php' );

add_filter( 'acf/settings/url', 'my_acf_settings_url' );
function my_acf_settings_url( $url ) {
	return MY_ACF_URL;
}

function rgb_code_acf_form_fields() {
	acf_add_local_field_group( [
		'key'                   => 'group_62eb94e23b40f',
		'title'                 => 'Form Fields',
		'fields'                => [
			[
				'key'               => 'field_62eb94edd501a',
				'label'             => 'Title',
				'name'              => 'title',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_62eb94fdd501b',
				'label'             => 'Subtitle',
				'name'              => 'subtitle',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_62eb9503d501c',
				'label'             => 'First Name Placeholder',
				'name'              => 'first_name_placeholder',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_62eb9512d501d',
				'label'             => 'Last Name Placeholder',
				'name'              => 'last_name_placeholder',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_62eb951bd501e',
				'label'             => 'Email Placeholder',
				'name'              => 'email_placeholder',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_62eb9547d501f',
				'label'             => 'Phone Placeholder',
				'name'              => 'phone_placeholder',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_62eb9550d5020',
				'label'             => 'Password Placeholder',
				'name'              => 'password_placeholder',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_62eb95d3d5021',
				'label'             => 'Password Strength Field',
				'name'              => 'password_strength_field',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_62eb95e4d5022',
				'label'             => 'Password Messages',
				'name'              => 'password_messages',
				'type'              => 'repeater',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'collapsed'         => '',
				'min'               => 0,
				'max'               => 0,
				'layout'            => 'table',
				'button_label'      => '',
				'sub_fields'        => [
					[
						'key'               => 'field_62eb95f0d5023',
						'label'             => 'Required Password Text Field',
						'name'              => 'required_password_text_field',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					],
					[
						'key'               => 'field_62eb9618d5024',
						'label'             => 'Password Error Message',
						'name'              => 'password_error_message',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					],
				],
			],
			[
				'key'               => 'field_62eb9652d5025',
				'label'             => 'Terms and Conditions Field Text',
				'name'              => 'terms_and_conditions_field_text',
				'type'              => 'wysiwyg',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'tabs'              => 'all',
				'toolbar'           => 'full',
				'media_upload'      => 1,
				'delay'             => 0,
			],
			[
				'key'               => 'field_62eb9663d5026',
				'label'             => 'Submit Button Text',
				'name'              => 'submit_button_text',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_62eb967bd5027',
				'label'             => 'Text After Button',
				'name'              => 'text_after_button',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			],
			[
				'key'               => 'field_62eb9692d5028',
				'label'             => 'Already have account link',
				'name'              => 'already_have_account_link',
				'type'              => 'link',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'return_format'     => 'array',
			],
		],
		'location'              => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'post',
				],
			],
		],
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
		'show_in_rest'          => 0,
	] );
}

add_action( 'acf/init', 'rgb_code_acf_form_fields' );

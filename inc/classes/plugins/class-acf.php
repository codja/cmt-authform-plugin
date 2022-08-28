<?php

namespace Rgbcode_authform\classes\plugins;

use Rgbcode_authform\traits\Singleton;

class ACF {

	use Singleton;

	public function __construct() {
		//      https://www.advancedcustomfields.com/resources/options-page/
		add_action( 'init', [ $this, 'register_options_page' ] );

		//      in this hook you need register your fields
		//      https://www.advancedcustomfields.com/resources/register-fields-via-php/
		add_action( 'init', [ $this, 'register_fields' ] );
	}

	public function register_options_page() {

		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(
				[
					'page_title' => __( 'Authform', 'rgbcode-authform' ),
					'menu_title' => __( 'Authform', 'rgbcode-authform' ),
					'menu_slug'  => 'rgbcode-authform-options',
					'capability' => 'edit_posts',
					'icon_url'   => 'dashicons-forms', // Add this line and replace the second inverted commas with class of the icon you like
					'position'   => 30,
					'redirect'   => false,
				]
			);
		}
	}

	public function register_fields() {
		if ( function_exists( 'acf_add_local_field_group' ) ) :

			acf_add_local_field_group(
				array(
					'key'                   => 'group_62f20424bf6b0',
					'title'                 => 'Authform settings',
					'fields'                => array(
						array(
							'key'               => 'field_630b0fb1d97ad',
							'label'             => 'Enable forms',
							'name'              => 'rgbc_authform_enable',
							'type'              => 'true_false',
							'instructions'      => '',
							'required'          => 0,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'message'           => '',
							'default_value'     => 0,
							'ui'                => 1,
							'ui_on_text'        => '',
							'ui_off_text'       => '',
						),
						array(
							'key'               => 'field_630b1083d97ae',
							'label'             => 'Sign Up',
							'name'              => '',
							'type'              => 'tab',
							'instructions'      => '',
							'required'          => 0,
							'conditional_logic' => array(
								array(
									array(
										'field'    => 'field_630b0fb1d97ad',
										'operator' => '==',
										'value'    => '1',
									),
								),
							),
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'placement'         => 'left',
							'endpoint'          => 0,
						),
						array(
							'key'               => 'field_62fb555a5a210',
							'label'             => 'Language',
							'name'              => 'rgbc_authform_lang',
							'type'              => 'select',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'choices'           => array(
								'en' => 'English',
								'ar' => 'Arabish',
								'es' => 'Spanish',
							),
							'default_value'     => 'en',
							'allow_null'        => 0,
							'multiple'          => 0,
							'ui'                => 0,
							'return_format'     => 'value',
							'ajax'              => 0,
							'placeholder'       => '',
						),
						array(
							'key'               => 'field_62f2122c05b9b',
							'label'             => 'Title block',
							'name'              => 'rgbc_authform_title_block',
							'type'              => 'group',
							'instructions'      => '',
							'required'          => 0,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'layout'            => 'block',
							'sub_fields'        => array(
								array(
									'key'               => 'field_62f2125d05b9c',
									'label'             => 'Title',
									'name'              => 'title',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 0,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => 'Sign up and Start Trading',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
								),
								array(
									'key'               => 'field_62f2128205b9d',
									'label'             => 'Subtitle',
									'name'              => 'subtitle',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 0,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => 'Please fill in your details below',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
								),
							),
						),
						array(
							'key'               => 'field_62f2043d6bdce',
							'label'             => 'Full Name',
							'name'              => 'rgbc_authform_full_name',
							'type'              => 'group',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'layout'            => 'block',
							'sub_fields'        => array(
								array(
									'key'               => 'field_62f20dce6bdcf',
									'label'             => 'Placeholder',
									'name'              => 'placeholder',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 1,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => 'Full name',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => 30,
								),
								array(
									'key'               => 'field_62f20df76bdd0',
									'label'             => 'Error text',
									'name'              => 'error_text',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 1,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => 'Please insert a valid name',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
								),
							),
						),
						array(
							'key'               => 'field_62f20e356bdd1',
							'label'             => 'Email',
							'name'              => 'rgbc_authform_email',
							'type'              => 'group',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'layout'            => 'block',
							'sub_fields'        => array(
								array(
									'key'               => 'field_62f20e9f6bdd2',
									'label'             => 'Placeholder',
									'name'              => 'placeholder',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 1,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => 'Email',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
								),
								array(
									'key'               => 'field_62f20ed86bdd3',
									'label'             => 'Error text',
									'name'              => 'error_text',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 1,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => 'Please insert a valid email address',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
								),
							),
						),
						array(
							'key'               => 'field_62f20fbadda6e',
							'label'             => 'Phone',
							'name'              => 'rgbc_authform_phone',
							'type'              => 'group',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'layout'            => 'block',
							'sub_fields'        => array(
								array(
									'key'               => 'field_62f20fbadda6f',
									'label'             => 'Placeholder',
									'name'              => 'placeholder',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 1,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => 'Phone',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
								),
								array(
									'key'               => 'field_62f20fbadda70',
									'label'             => 'Error text',
									'name'              => 'error_text',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 1,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => 'Please insert a valid phone number',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
								),
							),
						),
						array(
							'key'               => 'field_62f20fdfdda72',
							'label'             => 'Password',
							'name'              => 'rgbc_authform_pass',
							'type'              => 'group',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'layout'            => 'block',
							'sub_fields'        => array(
								array(
									'key'               => 'field_62f20fdfdda73',
									'label'             => 'Placeholder',
									'name'              => 'placeholder',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 1,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => 'Password',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
								),
								array(
									'key'               => 'field_62f20fdfdda74',
									'label'             => 'Error text',
									'name'              => 'error_text',
									'type'              => 'text',
									'instructions'      => '',
									'required'          => 1,
									'conditional_logic' => 0,
									'wrapper'           => array(
										'width' => '',
										'class' => '',
										'id'    => '',
									),
									'default_value'     => 'Must be at least 6 characters Use characters and numbers only',
									'placeholder'       => '',
									'prepend'           => '',
									'append'            => '',
									'maxlength'         => '',
								),
							),
						),
						array(
							'key'               => 'field_62f2108469f72',
							'label'             => 'Terms and Conditions',
							'name'              => 'rgbc_authform_terms',
							'type'              => 'wysiwyg',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '',
							'tabs'              => 'all',
							'toolbar'           => 'basic',
							'media_upload'      => 0,
							'delay'             => 0,
						),
						array(
							'key'               => 'field_62f210ec26e88',
							'label'             => 'Submit button',
							'name'              => 'rgbc_authform_submit',
							'type'              => 'text',
							'instructions'      => '',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => 'Submit',
							'placeholder'       => '',
							'prepend'           => '',
							'append'            => '',
							'maxlength'         => '',
						),
						array(
							'key'               => 'field_62f2114826e89',
							'label'             => 'Message under the button',
							'name'              => 'rgbc_authform_message',
							'type'              => 'text',
							'instructions'      => '',
							'required'          => 0,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => 'CFD and Forex trading involves substantial risk and may result in the loss of the invested capital.',
							'placeholder'       => '',
							'prepend'           => '',
							'append'            => '',
							'maxlength'         => '',
						),
						array(
							'key'               => 'field_62f211b426e8a',
							'label'             => 'Link',
							'name'              => 'rgbc_authform_link',
							'type'              => 'link',
							'instructions'      => 'Link at the bottom of the form',
							'required'          => 0,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'return_format'     => 'array',
						),
					),
					'location'              => array(
						array(
							array(
								'param'    => 'options_page',
								'operator' => '==',
								'value'    => 'rgbcode-authform-options',
							),
						),
					),
					'menu_order'            => 0,
					'position'              => 'normal',
					'style'                 => 'default',
					'label_placement'       => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen'        => '',
					'active'                => true,
					'description'           => '',
					'show_in_rest'          => 0,
				)
			);

		endif;
		// phpcs:enable
	}
}

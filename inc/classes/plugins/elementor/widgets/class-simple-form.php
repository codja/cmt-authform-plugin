<?php
/**
 * Elementor Simple Form Widget.
 *
 * Elementor widget that added form, which opened panda signup form.
 *
 * @since 1.0.0
 */

namespace Rgbcode_authform\classes\plugins\elementor\widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Simple_Form extends Widget_Base {

	public function get_script_depends() {
		wp_register_script(
			'rgbc-simple-form-script',
			RGBCODE_AUTHFORM_PLUGIN_URL . 'assets/js/elementor/widgets/simple-form.js',
			[ 'elementor-frontend' ],
			filemtime( RGBCODE_AUTHFORM_PLUGIN_DIR . 'assets/js/elementor/widgets/simple-form.js' ),
			true
		);

		return [ 'rgbc-simple-form-script' ];
	}

	public function get_style_depends() {
		wp_register_style(
			'rgbc-simple-form-style',
			RGBCODE_AUTHFORM_PLUGIN_URL . 'assets/css/elementor/widgets/simple-form.css',
			[],
			filemtime( RGBCODE_AUTHFORM_PLUGIN_DIR . 'assets/css/elementor/widgets/simple-form.css' )
		);

		return [ 'rgbc-simple-form-style' ];
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Stars widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rgbc-simple-form';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Stars widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Authform simple form', 'risco' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Stars widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Stars widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Form Settings', 'rgbcode-authform' ),
			]
		);

		$this->add_control(
			'firstname_placeholder',
			[
				'label'   => __( 'First Name Placeholder', 'rgbcode-authform' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'First Name',
			]
		);

		$this->add_control(
			'firstname_error',
			[
				'label'   => __( 'First Name Error Text', 'rgbcode-authform' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Please Enter Valid First Name',
			]
		);

		$this->add_control(
			'firstname_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'lastname_placeholder',
			[
				'label'   => __( 'Last name Placeholder', 'rgbcode-authform' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Last Name',
			]
		);

		$this->add_control(
			'lastname_error',
			[
				'label'   => __( 'Last Name Error Text', 'rgbcode-authform' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Please Enter Valid Last Name',
			]
		);

		$this->add_control(
			'submit_text',
			array(
				'label'   => __( 'Form Button Text', 'rgbcode-authform' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'REGISTER',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
<!--		<label>-->
<!--			<span>--><?php //echo esc_html( $settings['search'] ); ?><!--</span>-->
<!--			<input-->
<!--				class="search_input"-->
<!--				type="text"-->
<!--				name="search_input"-->
<!--				data-empty-text="--><?php //echo esc_attr( $settings['not_found_text'] ); ?><!--"-->
<!--			>-->
<!--			<img class="search_spinner" src="/wp-admin/images/spinner.gif" alt="risco_loading">-->
<!--		</label>-->
<!--		<table class="part_products_table">-->
<!--			<thead>-->
<!--				<tr>-->
<!--					<th>--><?php //echo esc_html( $settings['title_first_column'] ); ?><!--</th>-->
<!--					<th>--><?php //echo esc_html( $settings['title_second_column'] ); ?><!--</th>-->
<!--				</tr>-->
<!--			</thead>-->
<!--			<tbody></tbody>-->
<!--		</table>-->
		<?php
	}

	protected function content_template() {
		?>
<!--		<label>-->
<!--			<span>{{{settings.search}}}</span>-->
<!--			<input-->
<!--				class="search_input"-->
<!--				type="text"-->
<!--				name="search_input"-->
<!--				data-empty-text="{{{settings.not_found_text}}}"-->
<!--			>-->
<!--			<img class="search_spinner" src="/wp-admin/images/spinner.gif" alt="risco_loading">-->
<!--		</label>-->
<!--		<table class="part_products_table">-->
<!--			<thead>-->
<!--			<tr>-->
<!--				<th>{{{settings.title_first_column}}}</th>-->
<!--				<th>{{{settings.title_second_column}}}</th>-->
<!--			</tr>-->
<!--			</thead>-->
<!--			<tbody></tbody>-->
<!--		</table>-->
		<?php
	}

}

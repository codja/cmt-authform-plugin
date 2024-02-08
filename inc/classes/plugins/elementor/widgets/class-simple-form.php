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
			RGBCODE_AUTHFORM_PLUGIN_URL . 'assets/js/elementor/simple-form.js',
			[ 'elementor-frontend' ],
			filemtime( RGBCODE_AUTHFORM_PLUGIN_DIR . 'assets/js/elementor/simple-form.js' ),
			true
		);

		return [ 'rgbc-simple-form-script' ];
	}

	public function get_style_depends() {
		wp_register_style(
			'rgbc-simple-form-style',
			RGBCODE_AUTHFORM_PLUGIN_URL . 'assets/css/elementor/simple-form.min.css',
			[],
			filemtime( RGBCODE_AUTHFORM_PLUGIN_DIR . 'assets/css/elementor/simple-form.min.css' )
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
			'title',
			array(
				'label'       => __( 'Title', 'rgbcode-authform' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Start Trading Now', 'rgbcode-authform' ),
				'placeholder' => __( 'Enter your title', 'rgbcode-authform' ),
			)
		);

		$this->add_control(
			'title_size',
			array(
				'label'     => __( 'Title Font Size', 'elementor-cm-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 5,
				'max'       => 100,
				'step'      => 1,
				'default'   => 35,
				'condition' => [ 'title!' => '' ],
			)
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
			'submit_text',
			array(
				'label'   => __( 'Form Button Text', 'rgbcode-authform' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'REGISTER',
			)
		);

		$this->add_control(
			'is_fixed',
			array(
				'label'        => __( 'Fixed', 'elementor-cm-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'elementor-cm-addons' ),
				'label_off'    => __( 'No', 'elementor-cm-addons' ),
				'return_value' => 'yes',
				'default'      => 'no',
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
		$is_fixed = $settings['is_fixed'] ?? false;
		?>
		<form action="" class="rgbcode-simple-form <?php echo esc_attr( $is_fixed === 'yes' ? 'rgbcode-simple-form_fixed' : '' ); ?>">
			<h3
				class="rgbcode-simple-form__title"
				style="font-size: <?php echo esc_attr( $settings['title_size'] ); ?>px"
			>
				<?php echo esc_html( $settings['title'] ); ?>
			</h3>
			<input
				class="rgbcode-simple-form__input"
				type="text"
				name="firstname"
				placeholder="<?php echo esc_html( $settings['firstname_placeholder'] ); ?>"
				required
			>
			<input
				class="rgbcode-simple-form__input"
				type="text"
				name="lastname"
				placeholder="<?php echo esc_html( $settings['lastname_placeholder'] ); ?>"
				required
			>
			<button type="submit" class="rgbcode-simple-form__btn" disabled><?php echo esc_html( $settings['submit_text'] ); ?></button>
		</form>
		<?php
	}

	protected function content_template() {
		?>
		<form action="" class="rgbcode-simple-form">
			<h3
				class="rgbcode-simple-form__title"
				style="font-size: {{{settings.title_size}}}px"
			>
				{{{settings.title}}}
			</h3>
			<input
				class="rgbcode-simple-form__input"
				type="text"
				name="firstname"
				placeholder="{{{settings.firstname_placeholder}}}"
				required
			>
			<input
				class="rgbcode-simple-form__input"
				type="text"
				name="lastname"
				placeholder="{{{settings.lastname_placeholder}}}"
				required
			>
			<button type="submit" class="rgbcode-simple-form__btn" disabled>{{{settings.submit_text}}}</button>
		</form>
		<?php
	}

}

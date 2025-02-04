<?php

namespace Rgbcode_authform\classes\authform\forms;

use Rgbcode_authform\classes\authform\Authform;
use Rgbcode_authform\classes\helpers\Helpers;
use Rgbcode_authform\classes\helpers\Location;
use Rgbcode_authform\traits\Singleton;

class Deposit extends Baseform {

	use Singleton;

	const TEMPLATE_NAME = 'deposit';

	const ACTION = 'forexDeposit';

	public function get_template_data(): array {
		$registered_user = Authform::instance()->get_registered_user();
		return [
			'title_block'      => get_field( 'rgbc_authform_deposit_title_block', 'option' ),
			'country'          => get_field( 'rgbc_authform_deposit_country', 'option' ),
			//'currency'         => get_field( 'rgbc_authform_deposit_currency', 'option' ),
			'city'             => get_field( 'rgbc_authform_deposit_city', 'option' ),
			'address'          => get_field( 'rgbc_authform_deposit_address', 'option' ),
			'postcode'         => get_field( 'rgbc_authform_deposit_postcode', 'option' ),
			'birthday'         => get_field( 'rgbc_authform_deposit_birthday', 'option' ),
			'submit'           => get_field( 'rgbc_authform_deposit_submit', 'option' ),
			'logo'             => get_field( 'rgbc_authform_logo', 'option' ),
			//'whatsapp'         => $this->get_whatsapp_data(),
			'visibility_class' => Authform::HIDE_CLASS,
			'is_visible'       => (bool) $registered_user,
			'countries'        => $this->get_countries_with_currency(),
			'registered_user'  => $registered_user,
			//'currencies'       => Location::DEFAULT_CURRENCIES,
		];
	}

	/**
	 * Renders the authentication form shortcode.
	 *
	 * Usage: [authform-deposit is_visible="true"]
	 *
	 * @param array $atts Shortcode attributes.
	 *
	 * @return string Rendered HTML form output.
	 */
	public function render_form( array $atts = [] ): string {
		// Define default attributes
		$default_atts = [
			'is_visible' => true,
			'is_modal'   => false,
		];

		// Merge user-provided attributes with defaults
		$atts = shortcode_atts( $default_atts, $atts, 'authform-deposit' );

		// Sanitize attributes
		$atts['is_visible'] = filter_var( $atts['is_visible'], FILTER_VALIDATE_BOOLEAN );
		$atts['is_modal']   = filter_var( $atts['is_modal'], FILTER_VALIDATE_BOOLEAN );

		// Start output buffering
		ob_start();

		printf( '<div id="rgbcode-authform" class="rgbcode-authform-back">' );

		// Prepare data for the template
		$args = $this->get_template_data() + $atts;
		if ( empty( $args['registered_user'] ) ) {
			printf(
				'<p style="color:white">%s</p>',
				esc_html__( 'User not found.', 'rgbc' )
			);

			return ob_get_clean();
		}

		// Include the template
		$template_path = RGBCODE_AUTHFORM_TEMPLATES . '/' . self::TEMPLATE_NAME . '.php';
		if ( file_exists( $template_path ) ) {
			include $template_path;
		} else {
			echo esc_html__( 'Template not found.', 'rgbc' );
		}

		printf( '</div>' );

		// Return the rendered content
		return ob_get_clean();
	}

	private function get_countries_with_currency(): array {
//		$countries_with_custom_currency = $this->countries_with_custom_currency();

		$countries = [];
		foreach ( Location::COUNTRIES as $iso => $country ) {
			$countries[ $country['name'] ] = [
//				'currencies' => key_exists( $country['name'], $countries_with_custom_currency ) ? $countries_with_custom_currency[ $country['name'] ] : '',
				'iso'        => $iso,
			];
		}
		return $countries;
	}

	private function countries_with_custom_currency(): array {
		$raw_countries = Helpers::get_array( get_field( 'rgbc_authform_currencies', 'option' ) ?? [] );
		if ( ! $raw_countries ) {
			return [];
		}

		$result = [];
		foreach ( $raw_countries as $country ) {
			$country_name       = $country['country'] ?? '';
			$country_currencies = $country['currencies'] ?? '';

			if ( ! $country_name || ! $country_currencies ) {
				continue;
			}

			$is_empty_value_needed = $country['is_empty_value'] ?? false;
			$empty_option_text     = get_field( 'empty_option_txt', 'option' );

			if ( $is_empty_value_needed && $empty_option_text ) {
				array_unshift( $country_currencies, $empty_option_text );
			}

			$result[ $country_name ] = wp_json_encode( $country_currencies );
		}

		return $result;
	}

	private function get_whatsapp_data(): ?array {
		$data = get_field( 'rgbc_authform_whatsapp', 'option' );

		if ( ! $data ) {
			return null;
		}

		$whatsapp_link = $this->get_whatsapp_link( $data );
		if ( ! $whatsapp_link ) {
			return null;
		}

		$data['link']  = $whatsapp_link;
		$data['style'] = $this->get_whatsapp_style( $data );

		return $data;
	}

	private function get_whatsapp_link( $data ): ?string {
		$phone_number = $data['phone_number'] ?? '';
		$text         = $data['whatsapp_text'] ?? '';

		if ( ! $phone_number ) {
			return null;
		}

		return add_query_arg(
			[
				'phone' => $phone_number,
				'text'  => $text,
			],
			'https://api.whatsapp.com/send'
		);
	}

	private function get_whatsapp_style( $data ): string {
		$back_color = $data['whatsapp_btn_back_color'] ?? null;
		$text_color = $data['whatsapp_btn_txt_color'] ?? null;

		$result = '';

		if ( $back_color || $text_color ) {
			$styles  = [];
			$result .= 'style=';

			if ( ! empty( $back_color ) ) {
				$styles[] = "background-color:$back_color";
			}

			if ( ! empty( $back_color ) ) {
				$styles[] = "color:$text_color";
			}

			$result .= implode( ';', $styles );
			$result .= ';';
		}

		return $result;
	}
}

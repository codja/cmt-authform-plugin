<?php

namespace Rgbcode_authform\classes\authform\forms;

use Rgbcode_authform\classes\authform\Authform;
use Rgbcode_authform\classes\helpers\Location;
use Rgbcode_authform\traits\Singleton;

class Deposit extends Baseform {

	use Singleton;

	const TEMPLATE_NAME = 'deposit';

	const ACTION = 'forexDeposit';

	public function get_template_data(): array {
		return [
			'title_block'      => get_field( 'rgbc_authform_deposit_title_block', 'option' ),
			'country'          => get_field( 'rgbc_authform_deposit_country', 'option' ),
			'city'             => get_field( 'rgbc_authform_deposit_city', 'option' ),
			'address'          => get_field( 'rgbc_authform_deposit_address', 'option' ),
			'postcode'         => get_field( 'rgbc_authform_deposit_postcode', 'option' ),
			'birthday'         => get_field( 'rgbc_authform_deposit_birthday', 'option' ),
			'submit'           => get_field( 'rgbc_authform_deposit_submit', 'option' ),
			'logo'             => get_field( 'rgbc_authform_logo', 'option' ),
			'whatsapp'         => $this->get_whatsapp_data(),
			'visibility_class' => Authform::HIDE_CLASS,
			'countries'        => $this->get_countries_with_currency(),
			'currencies'       => Location::DEFAULT_CURRENCIES,
			'registered_user'  => Authform::instance()->get_registered_user(),
		];
	}

	private function get_countries_with_currency(): array {
		$countries_with_custom_currency = $this->countries_with_custom_currency();

		$countries = [];
		foreach ( Location::COUNTRIES as $country ) {
			$countries[ $country['name'] ] = [
				'currencies' => key_exists( $country['name'], $countries_with_custom_currency ) ? $countries_with_custom_currency[ $country['name'] ] : '',
				'iso'        => $country['iso'],
			];
		}
		return $countries;
	}

	private function countries_with_custom_currency(): array {
		$raw_countries = get_field( 'rgbc_authform_currencies', 'option' );

		if ( ! $raw_countries ) {
			return [];
		}

		$result = [];
		foreach ( $raw_countries as $country ) {
			$result[ $country['country'] ] = wp_json_encode( $country['currencies'] );
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

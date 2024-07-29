<?php

namespace Rgbcode_authform\classes\authform\forms;

abstract class Baseform {

	const TEMPLATE_NAME = '';

	const ACTION = '';

	public function get_template_data(): array {
		return [];
	}

	protected function shortcode_btn( $type, $atts = [] ): string {
		if ( ! in_array( $type, [ 'signup', 'login' ], true ) ) {
			return '';
		}

		$default_btn_settings = get_field( "rgbc_authform_{$type}_default_block", 'option' );
		$system_classes       = "js-rgbcode-authform js-{$type}-btn";

		$id      = $atts['id'] ?? '';
		$classes = $atts['classes'] ?? '';
		$text    = $atts['text'] ?? ( $default_btn_settings['btn_text'] ?? '' );

		$override_link = $default_btn_settings['override_link'] ?? '';
		if ( $override_link ) {
			return sprintf(
				'<a id="%s" href="%s" class="%s">%s</a>',
				esc_attr( $id ),
				esc_url( $override_link ),
				esc_attr( $classes ),
				esc_html( $text ),
			);
		}

		return sprintf(
			'<button id="%s" class="%s" data-target="%s">%s</button>',
			esc_attr( $id ),
			esc_attr( trim( "$system_classes $classes" ) ),
			esc_attr( "rgbcode-{$type}" ),
			esc_html( $text ),
		);
	}
}

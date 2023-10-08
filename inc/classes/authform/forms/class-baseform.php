<?php

namespace Rgbcode_authform\classes\authform\forms;

use Rgbcode_authform\classes\authform\Authform;

abstract class Baseform {

	const TEMPLATE_NAME = '';

	const SLUG = '';

	const ACTION = '';

	const TARGET = '';

	const SHORTCODE_TAG = '';

	public function get_template_data(): array {
		return [];
	}

	public static function render_btn( $atts = [] ): string {
		if ( ! static::TARGET ) {
			return '';
		}

		$id      = $atts['id'] ?? '';
		$classes = $atts['classes'] ?? '';
		$text    = $atts['text'] ?? '';

		return sprintf(
			'<button id="%s" class="js-rgbcode-authform %s %s" data-target="%s">%s</button>',
			esc_attr( $id ),
			esc_attr( 'js-' . static::SLUG . 'btn' ),
			esc_attr( $classes ),
			esc_attr( static::TARGET ),
			esc_html( $text ),
		);
	}
}

<?php

$logo = $args ?? '';

if ( $logo ) : ?>
	<img
		class="rgbcode-authform-form__logo"
		src="<?php echo esc_url( $logo['url'] ?? '' ); ?>"
		alt="<?php echo esc_attr( $logo['alt'] ?? '' ); ?>"
		height="<?php echo esc_attr( $logo['height'] ?? '' ); ?>"
		width="<?php echo esc_attr( $logo['width'] ?? '' ); ?>"
		title="<?php echo esc_attr( $logo['title'] ?? '' ); ?>"
	>
<?php endif; ?>

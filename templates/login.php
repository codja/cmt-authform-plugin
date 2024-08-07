<?php
	$visibility_class = $args['visibility_class'] ?? '';
?>

<div class="rgbcode-authform-modal <?php echo esc_attr( $visibility_class ); ?>" id="rgbcode-login">
	<button class="rgbcode-authform-modal__close rgbcode-authform-close" type="button"></button>

	<form class="rgbcode-authform-form rgbcode-authform-form_login">

		<?php
		if ( ! empty( $args['logo'] ) ) {
			load_template( RGBCODE_AUTHFORM_PARTIALS . '/img-from-acf.php', false, $args['logo'] );
		}
		?>

		<?php if ( ! empty( $args['title_block']['title'] ) ) : ?>
			<div class="rgbcode-authform-form__title">
				<?php echo esc_html( $args['title_block']['title'] ); ?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $args['title_block']['subtitle'] ) ) : ?>
			<div class="rgbcode-authform-form__subtitle">
				<?php echo esc_html( $args['title_block']['subtitle'] ); ?>
			</div>
		<?php endif; ?>

		<div class="rgbcode-authform-form__inputs">

			<?php if ( ! empty( $args['email'] ) ) : ?>
				<div class="rgbcode-authform-input rgbcode-authform-input_icon rgbcode-authform-input_email">
					<label class="rgbcode-authform-input__label">
						<input
							type="email"
							name="email"
							placeholder="<?php echo esc_attr( $args['email']['placeholder'] ?? '' ); ?>"
							tabindex="3"
							autocomplete="off"
							required
						>
					</label>

					<span class="rgbcode-authform-input__error <?php echo esc_attr( $visibility_class ); ?>">
						<?php echo esc_html( $args['email']['error_text'] ?? '' ); ?>
					</span>

				</div>
			<?php endif; ?>

			<?php if ( ! empty( $args['pass'] ) ) : ?>
			<div class="rgbcode-authform-input rgbcode-authform-input_icon rgbcode-authform-input_pass">
				<div class="rgbcode-authform-input__label">
					<input
						id="pass"
						type="password"
						name="password"
						placeholder="<?php echo esc_attr( $args['pass']['placeholder'] ?? '' ); ?>"
						tabindex="6"
						autocomplete="off"
						required
					>
					<button type="button" class="rgbcode-authform-pass-toggle"></button>
				</div>
				<span class="rgbcode-authform-input__error <?php echo esc_attr( $visibility_class ); ?>">
					<?php echo esc_html( $args['pass']['error_text'] ); ?>
				</span>
			</div>
		<?php endif; ?>

		</div>

		<div class="rgbcode-authform-input__error rgbcode-authform-input__error_submit <?php echo esc_attr( $visibility_class ); ?>"></div>

		<button id="rgbcode-login-submit" class="rgbcode-authform-button" tabindex="8" type="submit" disabled>
			<?php echo esc_html( $args['submit'] ?? __( 'Submit', 'rgbcode-authform' ) ); ?>
		</button>
	</form>
</div>

<?php
$visibility_class = $args['visibility_class'] ?? '';
?>

<div class="rgbcode-authform-modal  <?php echo esc_attr( $visibility_class ); ?>" id="rgbcode-login">
	<button class="rgbcode-authform-modal__close rgbcode-authform-close" type="button"></button>

	<form class="rgbcode-authform-form rgbcode-authform-form_login">

		<?php
		if ( ! empty( $args['logo'] ) ) {
			load_template( RGBCODE_AUTHFORM_PARTIALS . '/img-from-acf.php', false, $args['logo'] );
		}
		?>

		<div class="rgbcode-authform-form__inputs">
			<?php if ( ! empty( $args['email'] ) ) : ?>
				<div class="rgbcode-authform-input rgbcode-authform-input_icon rgbcode-authform-input_email">
					<label class="rgbcode-authform-input__label">
						<input
							type="email"
							name="login"
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

		<?php if ( ! empty( $args['forgot'] ) ) : ?>
			<button type="button" class="js-authform-forgot"><?php echo esc_html( $args['forgot'] ); ?></button>
		<?php endif; ?>

		<div class="rgbcode-authform-input__error rgbcode-authform-input__error_submit <?php echo esc_attr( $visibility_class ); ?>"></div>
		<button id="rgbcode-signup-submit" class="rgbcode-authform-button" tabindex="8" type="submit" disabled>
			<?php echo esc_html( $args['submit'] ?? __( 'Submit', 'rgbcode-authform' ) ); ?>
		</button>

		<?php if ( ! empty( $args['bottom_login_link'] ) ) : ?>
			<p><?php echo esc_html( $args['bottom_login_link']['first_text'] ?? '' ); ?>
				<a href="#" class="js-authform-start"><?php echo esc_html( $args['bottom_login_link']['link_text'] ?? '' ); ?></a>
			</p>
		<?php endif; ?>
	</form>

</div>

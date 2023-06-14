<?php
	$visibility_class = $args['visibility_class'] ?? '';
	$not_allowed      = $args['default_country']['not_allowed'] ?? '';
?>

<div class="rgbcode-authform-modal <?php echo esc_attr( $visibility_class ); ?>" id="rgbcode-signup">
	<button class="rgbcode-authform-modal__close rgbcode-authform-close" type="button"></button>

	<div class="rgbcode-authform-message <?php echo esc_attr( ! $not_allowed ? $visibility_class : '' ); ?>">
		<button class="rgbcode-authform-message__close rgbcode-authform-close"></button>
		<div class="rgbcode-authform-message__txt">
			<?php echo esc_html__( 'We currently do not accept customers from your region', 'rgbcode-authform' ); ?>
		</div>
	</div>

	<form class="rgbcode-authform-signup">

		<?php if ( ! empty( $args['title_block']['title'] ) ) : ?>
		<div class="rgbcode-authform-signup__title">
			<?php echo esc_html( $args['title_block']['title'] ); ?>
		</div>
		<?php endif; ?>

		<?php if ( ! empty( $args['title_block']['subtitle'] ) ) : ?>
		<div class="rgbcode-authform-signup__subtitle">
			<?php echo esc_html( $args['title_block']['subtitle'] ); ?>
		</div>
		<?php endif; ?>

		<?php if ( ! empty( $args['first_name'] ) ) : ?>
		<div class="rgbcode-authform-signup__inputs">
			<div class="rgbcode-authform-input rgbcode-authform-input_user rgbcode-authform-input_firstname">
				<label class="rgbcode-authform-input__label">
					<input
						type="text"
						name="firstname"
						maxlength="50"
						minlength="3"
						placeholder="<?php echo esc_attr( $args['first_name']['placeholder'] ?? '' ); ?>"
						tabindex="1"
						autocomplete="off"
						required
					>
				</label>
				<span class="rgbcode-authform-input__error <?php echo esc_attr( $visibility_class ); ?>">
					<?php echo esc_html( $args['first_name']['error_text'] ?? '' ); ?>
				</span>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $args['last_name'] ) ) : ?>
			<div class="rgbcode-authform-input rgbcode-authform-input_user rgbcode-authform-input_lastname">
				<label class="rgbcode-authform-input__label">
					<input
						type="text"
						name="lastname"
						maxlength="50"
						minlength="3"
						placeholder="<?php echo esc_attr( $args['last_name']['placeholder'] ?? '' ); ?>"
						tabindex="2"
						autocomplete="off"
						required
					>
				</label>
				<span class="rgbcode-authform-input__error <?php echo esc_attr( $visibility_class ); ?>">
					<?php echo esc_html( $args['last_name']['error_text'] ?? '' ); ?>
				</span>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $args['email'] ) ) : ?>
			<div class="rgbcode-authform-input rgbcode-authform-input_email">
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

			<div class="rgbcode-authform-flag-input" tabindex="4">
				<img
					class="rgbcode-authform-flag-input__flag"
					src="<?php echo esc_url( RGBCODE_AUTHFORM_IMAGES . '/flags/' . strtolower( $args['default_country']['country']['iso'] ?? 'af' ) . '.svg' ); ?>" alt=""
				>

				<span class="rgbcode-authform-flag-input__code" data-iso="<?php echo esc_attr( $args['default_country']['country']['iso'] ?? 'af' ); ?>">
					<?php echo esc_html( $args['default_country']['country']['code'] ?? '+93' ); ?>
				</span>

				<?php if ( ! empty( $args['countries'] ) ) : ?>
				<div class="rgbcode-authform-flag-input__select <?php echo esc_attr( $visibility_class ); ?>">
					<button class="rgbcode-authform-close"></button>
					<ul class="rgbcode-authform-flag-input__ul">
						<?php foreach ( $args['countries'] as $country ) : ?>
							<li
								class="rgbcode-authform-flag-input__option"
								data-code="<?php echo esc_attr( $country['code'] ); ?>"
								data-iso="<?php echo esc_attr( $country['iso'] ); ?>"
								data-src="<?php echo esc_url( RGBCODE_AUTHFORM_IMAGES . '/flags/' . strtolower( $country['iso'] ) . '.svg' ); ?>"
							>
								<?php echo esc_html( $country['name'] ); ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>

			</div>

			<?php if ( ! empty( $args['phone'] ) ) : ?>
			<div class="rgbcode-authform-input rgbcode-authform-input_phone">
				<label class="rgbcode-authform-input__label">
					<input
						type="text"
						inputmode="tel"
						maxlength="10"
						minlength="6"
						name="phone"
						placeholder="<?php echo esc_attr( $args['phone']['placeholder'] ?? '' ); ?>"
						tabindex="5"
						autocomplete="off"
						required
					>
				</label>
				<span class="rgbcode-authform-input__error <?php echo esc_attr( $visibility_class ); ?>">
					<?php echo esc_html( $args['phone']['error_text'] ?? '' ); ?>
				</span>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $args['pass'] ) ) : ?>
			<div class="rgbcode-authform-input rgbcode-authform-input_pass">
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
				<section class="rgbcode-authform-tooltip <?php echo esc_attr( $visibility_class ); ?>">
					<h5 class="rgbcode-authform-tooltip__title">
						<?php echo esc_html__( 'Your Password Must have:', 'rgbcode-authform' ); ?>
					</h5>
					<span class="rgbcode-authform-tooltip__triangle"></span>
					<ul class="rgbcode-authform-tooltip__list">
						<li id="rgbc-length" class="rgbcode-authform-tooltip__item">
							<?php echo esc_html__( 'Length between 6 and 12 characters', 'rgbcode-authform' ); ?>
						</li>
						<li id="rgbc-lower" class="rgbcode-authform-tooltip__item">
							<?php echo esc_html__( 'At least one lowercase character', 'rgbcode-authform' ); ?>
						</li>
						<li id="rgbc-upper" class="rgbcode-authform-tooltip__item">
							<?php echo esc_html__( 'At least one uppercase character', 'rgbcode-authform' ); ?>
						</li>
						<li id="rgbc-num" class="rgbcode-authform-tooltip__item">
							<?php echo esc_html__( 'At least one number', 'rgbcode-authform' ); ?>
						</li>
					</ul>
				</section>
			</div>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $args['pass'] ) ) : ?>
		<div class="rgbcode-authform-pass-strength" data-msgs="<?php echo esc_attr( wp_json_encode( $args['msgs'] ?? '' ) ); ?>">
			<div class="rgbcode-authform-pass-strength__indicator">
				<div class="rgbcode-authform-pass-strength__item"></div>
				<div class="rgbcode-authform-pass-strength__item"></div>
				<div class="rgbcode-authform-pass-strength__item"></div>
			</div>
			<span
				class="rgbcode-authform-pass-strength__msg"
				data-default="<?php echo esc_attr__( 'Password Strength', 'rgbcode-authform' ); ?>">
				<?php echo esc_html__( 'Password Strength', 'rgbcode-authform' ); ?>
			</span>
		</div>
		<?php endif; ?>

		<?php if ( ! empty( $args['terms'] ) ) : ?>
		<label class="rgbcode-authform-input__label rgbcode-authform-checkbox">
			<input type="checkbox" class="rgbcode-authform-checkbox__input" name="agree" tabindex="7" required>
			<span class="rgbcode-authform-checkbox__box"></span>
			<?php echo wp_kses_post( $args['terms'] ); ?>
		</label>
		<?php endif; ?>

		<div class="rgbcode-authform-input__error rgbcode-authform-input__error_submit <?php echo esc_attr( $visibility_class ); ?>"></div>
		<button id="rgbcode-signup-submit" class="rgbcode-authform-button" type="submit" disabled>
			<?php echo esc_html( $args['submit'] ?? __( 'Submit', 'rgbcode-authform' ) ); ?>
		</button>

		<?php if ( ! empty( $args['message'] ) ) : ?>
		<div class="rgbcode-authform-text rgbcode-authform-text_center">
			<?php echo esc_html( $args['message'] ); ?>
		</div>
		<?php endif; ?>

		<?php
		if (
			! empty( $args['bottom_link']['url'] )
			|| ! empty( $args['bottom_link']['title'] )
		) :
			?>
		<a
			class="rgbcode-authform-signup__link"
			href="<?php echo esc_url( $args['bottom_link']['url'] ); ?>"
			target="<?php echo esc_url( $args['bottom_link']['target'] ?? '_self' ); ?>"
		>
			<?php echo esc_html( $args['bottom_link']['title'] ); ?>
		</a>
		<?php endif; ?>

	</form>
</div>

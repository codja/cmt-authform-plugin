<div class="rgbcode-authform-modal rgbcode-hidden" id="rgbcode-signup">
	<button class="rgbcode-authform-modal__close rgbcode-authform-close" type="button"></button>

	<div class="rgbcode-authform-message <?php echo esc_attr( ! $args['default_country']['not_allowed'] ? 'rgbcode-hidden' : '' ); ?>">
		<button class="rgbcode-authform-message__close rgbcode-authform-close"></button>
		<div class="rgbcode-authform-message__txt">
			<?php echo esc_html__( 'We currently do not accept customers from your region', 'rgbcode-authform' ); ?>
		</div>
	</div>

	<form class="rgbcode-authform-signup">

		<?php if ( $args['title_block']['title'] ) : ?>
		<div class="rgbcode-authform-signup__title">
			<?php echo esc_html( $args['title_block']['title'] ); ?>
		</div>
		<?php endif; ?>

		<?php if ( $args['title_block']['subtitle'] ) : ?>
		<div class="rgbcode-authform-signup__subtitle">
			<?php echo esc_html( $args['title_block']['subtitle'] ); ?>
		</div>
		<?php endif; ?>

		<div class="rgbcode-authform-signup__inputs">
			<div class="rgbcode-authform-input rgbcode-authform-input_user">
				<label class="rgbcode-authform-input__label">
					<input
						type="text"
						name="full_name"
						maxlength="100"
						minlength="4"
						placeholder="<?php echo esc_attr( $args['full_name']['placeholder'] ); ?>"
						tabindex="1"
						autocomplete="off"
						required
					>
				</label>
				<span class="rgbcode-authform-input__error rgbcode-hidden">
					<?php echo esc_html( $args['full_name']['error_text'] ); ?>
				</span>
			</div>

			<div class="rgbcode-authform-input rgbcode-authform-input_email">
				<label class="rgbcode-authform-input__label">
					<input
						type="email"
						name="email"
						placeholder="<?php echo esc_attr( $args['email']['placeholder'] ); ?>"
						tabindex="2"
						autocomplete="off"
						required
					>
				</label>
				<span class="rgbcode-authform-input__error rgbcode-hidden">
					<?php echo esc_html( $args['email']['error_text'] ); ?>
				</span>
			</div>

			<div class="rgbcode-authform-flag-input" tabindex="3">
				<img
					class="rgbcode-authform-flag-input__flag"
					src="<?php echo esc_url( RGBCODE_AUTHFORM_IMAGES . '/flags/' . strtolower( $args['default_country']['country']['iso'] ) . '.svg' ); ?>" alt=""
				>

				<span class="rgbcode-authform-flag-input__code" data-iso="<?php echo esc_attr( $args['default_country']['country']['iso'] ); ?>">
					<?php echo esc_html( $args['default_country']['country']['code'] ); ?>
				</span>

				<div class="rgbcode-authform-flag-input__select rgbcode-hidden">
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

			</div>

			<div class="rgbcode-authform-input rgbcode-authform-input_phone">
				<label class="rgbcode-authform-input__label">
					<input
						type="text"
						inputmode="tel"
						maxlength="10"
						minlength="6"
						name="phone"
						placeholder="<?php echo esc_attr( $args['phone']['placeholder'] ); ?>"
						tabindex="4"
						autocomplete="off"
						required
					>
				</label>
				<span class="rgbcode-authform-input__error rgbcode-hidden">
					<?php echo esc_html( $args['phone']['error_text'] ); ?>
				</span>
			</div>

			<div class="rgbcode-authform-input rgbcode-authform-input_pass">
				<div class="rgbcode-authform-input__label">
					<input
						id="pass"
						type="password"
						name="password"
						placeholder="<?php echo esc_attr( $args['pass']['placeholder'] ); ?>"
						tabindex="5"
						autocomplete="off"
						required
					>
					<button type="button" class="rgbcode-authform-pass-toggle"></button>
				</div>
				<span class="rgbcode-authform-input__error rgbcode-hidden">
					<?php echo esc_html( $args['pass']['error_text'] ); ?>
				</span>
				<section class="rgbcode-authform-tooltip rgbcode-hidden">
					<h5 class="rgbcode-authform-tooltip__title">
						<?php echo esc_html__( 'Your Password Must have:', 'rgbcode-authform' ); ?>
					</h5>
					<span class="rgbcode-authform-tooltip__triangle"></span>
					<ul class="rgbcode-authform-tooltip__list">
						<li id="rgbc-length" class="rgbcode-authform-tooltip__item">
							<?php echo esc_html__( 'Length between 6 and 20 characters', 'rgbcode-authform' ); ?>
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
		</div>

		<div class="rgbcode-authform-pass-strength" data-msgs="<?php echo esc_attr( wp_json_encode( $args['msgs'] ) ); ?>">
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

		<?php if ( $args['terms'] ) : ?>
		<label class="rgbcode-authform-input__label rgbcode-authform-checkbox">
			<input type="checkbox" class="rgbcode-authform-checkbox__input" name="agree" tabindex="6" required>
			<span class="rgbcode-authform-checkbox__box"></span>
			<?php echo wp_kses_post( $args['terms'] ); ?>
		</label>
		<?php endif; ?>

		<div class="rgbcode-authform-input__error rgbcode-authform-input__error_submit rgbcode-hidden"></div>
		<button id="rgbcode-signup-submit" class="rgbcode-authform-button" type="submit" disabled>
			<?php echo esc_html( $args['submit'] ); ?>
		</button>

		<?php if ( $args['message'] ) : ?>
		<div class="rgbcode-authform-text rgbcode-authform-text_center">
			<?php echo esc_html( $args['message'] ); ?>
		</div>
		<?php endif; ?>

		<?php if ( $args['bottom_link'] ) : ?>
		<a
			class="rgbcode-authform-signup__link"
			href="<?php echo esc_url( $args['bottom_link']['url'] ); ?>"
			target="<?php echo esc_url( $args['bottom_link']['target'] ); ?>"
		>
			<?php echo esc_html( $args['bottom_link']['title'] ); ?>
		</a>
		<?php endif; ?>

	</form>
</div>

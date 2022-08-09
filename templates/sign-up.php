<div class="rgbcode-authform-modal" id="signup">
	<button class="rgbcode-authform-modal__close" type="button"></button>
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
						required
					>
				</label>
				<span class="rgbcode-authform-input__error">
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
						required
					>
				</label>
				<span class="rgbcode-authform-input__error">
					<?php echo esc_html( $args['email']['error_text'] ); ?>
				</span>
			</div>

			<div class="rgbcode-authform-flag-input" tabindex="3">+ 46</div>

			<div class="rgbcode-authform-input rgbcode-authform-input_phone">
				<label class="rgbcode-authform-input__label">
					<input
						type="text"
						maxlength="17"
						minlength="5"
						name="phone"
						placeholder="<?php echo esc_attr( $args['phone']['placeholder'] ); ?>"
						tabindex="4"
						required
					>
				</label>
				<span class="rgbcode-authform-input__error">
					<?php echo esc_html( $args['phone']['error_text'] ); ?>
				</span>
			</div>

			<div class="rgbcode-authform-input rgbcode-authform-input_key">
				<label class="rgbcode-authform-input__label">
					<input
						type="password"
						name="password"
						placeholder="<?php echo esc_attr( $args['pass']['placeholder'] ); ?>"
						tabindex="5"
						required
					>
				</label>
				<span class="rgbcode-authform-input__error">
					<?php echo esc_html( $args['pass']['error_text'] ); ?>
				</span>
			</div>
		</div>

		<?php if ( $args['terms'] ) : ?>
		<label class="rgbcode-authform-checkbox">
			<input type="checkbox" class="rgbcode-authform-checkbox__input" tabindex="6" required>
			<span class="rgbcode-authform-checkbox__box"></span>
			<?php echo wp_kses_post( $args['terms'] ); ?>
		</label>
		<?php endif; ?>

		<button class="rgbcode-authform-button" type="submit" disabled>
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

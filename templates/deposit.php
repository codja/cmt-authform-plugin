<?php
	$visibility_class = $args['visibility_class'] ?? '';
	$registered_user  = ! empty( $args['registered_user'] ) ? wp_json_encode( $args['registered_user'] ) : '';
?>
<div class="rgbcode-authform-modal <?php echo esc_attr( $visibility_class ); ?>" id="rgbcode-deposit">
	<button class="rgbcode-authform-modal__close rgbcode-authform-close" type="button"></button>
	<form class="rgbcode-authform-form" data-user="<?php echo esc_attr( $registered_user ); ?>">

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

			<?php
			$default_currencies = $args['currencies'] ?? [];
			if ( ! empty( $args['country'] ) && ! empty( $args['countries'] ) ) :
				?>

			<div class="rgbcode-authform-form__two-selects">

				<div class="rgbcode-authform-select js-select-list">
					<div class="rgbcode-authform-select__country-menu">
						<span class="rgbcode-authform-select__label"><?php echo esc_html( $args['country'] ); ?></span>
						<div class="rgbcode-authform-select__country-menu-current js-select-list-current"></div>
						<div class="rgbcode-authform-select__country-menu-list js-select-list-list"></div>
					</div>
					<select
						id="rgbcode-authform-deposit-country"
						class="rgbcode-authform-select__select js-select-list-select"
						name="country"
						tabindex="1"
						autocomplete="off"
						data-default-currencies="<?php echo esc_attr( wp_json_encode( $default_currencies ) ); ?>"
						required
					>
						<?php
						foreach ( $args['countries'] as $country => $data ) :
							$currencies = $data['currencies'] ?? '';
							$iso        = $data['iso'] ?? '';
							?>
							<option
								value="<?php echo esc_attr( $iso ); ?>"
								<?php if ( $currencies ) : ?>
								data-currency="<?php echo esc_attr( $currencies ); ?>"
								<?php endif; ?>
							><?php echo esc_html( $country ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="rgbcode-authform-input rgbcode-authform-input_currency">
					<label class="rgbcode-authform-input__label">
						<span><?php echo esc_html( $args['currency']['label'] ?? '' ); ?></span>
						<select
							id="rgbcode-authform-deposit-currency"
							name="currency"
							tabindex="2"
							autocomplete="off"
							required
						>
							<?php foreach ( $default_currencies as $currency ) : ?>
							<option
								value="<?php echo esc_attr( $currency ); ?>">
								<?php echo esc_html( $currency ); ?>
							</option>
							<?php endforeach; ?>
						</select>
					</label>
					<span class="rgbcode-authform-input__error <?php echo esc_attr( $visibility_class ); ?>">
						<?php echo esc_html( $args['currency']['error_text'] ?? '' ); ?>
					</span>
				</div>
			</div>

			<?php endif; ?>

			<?php if ( ! empty( $args['city'] ) ) : ?>
			<div class="rgbcode-authform-input">
				<label class="rgbcode-authform-input__label">
					<span><?php echo esc_html( $args['city']['label'] ?? '' ); ?></span>
					<input
						type="text"
						name="city"
						maxlength="50"
						minlength="2"
						tabindex="3"
						autocomplete="off"
						required
					>
				</label>
				<span class="rgbcode-authform-input__error <?php echo esc_attr( $visibility_class ); ?>">
					<?php echo esc_html( $args['city']['error_text'] ?? '' ); ?>
				</span>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $args['address'] ) ) : ?>
			<div class="rgbcode-authform-input">
				<label class="rgbcode-authform-input__label">
					<span><?php echo esc_html( $args['address']['label'] ?? '' ); ?></span>
					<input
						type="text"
						name="address"
						maxlength="50"
						minlength="2"
						tabindex="4"
						autocomplete="off"
						required
					>
				</label>
				<span class="rgbcode-authform-input__error <?php echo esc_attr( $visibility_class ); ?>">
					<?php echo esc_html( $args['address']['error_text'] ?? '' ); ?>
				</span>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $args['postcode'] ) ) : ?>
			<div class="rgbcode-authform-input">
				<label class="rgbcode-authform-input__label">
					<span><?php echo esc_html( $args['postcode']['label'] ?? '' ); ?></span>
					<input
						type="text"
						name="postcode"
						maxlength="50"
						minlength="2"
						tabindex="5"
						autocomplete="off"
						required
					>
				</label>
				<span class="rgbcode-authform-input__error <?php echo esc_attr( $visibility_class ); ?>">
					<?php echo esc_html( $args['postcode']['error_text'] ?? '' ); ?>
				</span>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $args['birthday'] ) ) : ?>
				<div class="rgbcode-authform-input">
					<label class="rgbcode-authform-input__label">
						<span><?php echo esc_html( $args['birthday']['label'] ?? '' ); ?></span>
						<input
							id="rgbcode-authform-birthday"
							type="text"
							name="birthday"
							tabindex="6"
							autocomplete="off"
							placeholder="<?php echo esc_html( $args['birthday']['placeholder'] ?? '' ); ?>"
							required
						>
					</label>
					<span class="rgbcode-authform-input__error <?php echo esc_attr( $visibility_class ); ?>">
					<?php echo esc_html( $args['birthday']['error_text'] ?? '' ); ?>
				</span>
				</div>
			<?php endif; ?>

		</div>

		<div class="rgbcode-authform-input__error rgbcode-authform-input__error_submit <?php echo esc_attr( $visibility_class ); ?>"></div>
		<div class="rgbcode-authform-buttons">
			<?php
				$whatsapp_btn = $args['whatsapp'] ?? '';
			if ( $whatsapp_btn ) :
				?>
			<button
				type="submit"
				data-href="<?php echo esc_url_raw( $whatsapp_btn['link'] ?? '#' ); ?>"
				class="rgbcode-authform-button rgbcode-authform-button_whatsapp"
				disabled
				<?php
				if ( ! empty( $whatsapp_btn['style'] ) ) {
					echo esc_attr( $whatsapp_btn['style'] );
				}
				?>
			>
				<img width="39" height="39" alt="<?php echo esc_attr( $whatsapp_btn['button_text'] ?? '' ); ?>" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 175.216 175.552'%3E%3Cdefs%3E%3ClinearGradient id='b' x1='85.915' x2='86.535' y1='32.567' y2='137.092' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%2357d163'/%3E%3Cstop offset='1' stop-color='%2323b33a'/%3E%3C/linearGradient%3E%3Cfilter id='a' width='1.115' height='1.114' x='-.057' y='-.057' color-interpolation-filters='sRGB'%3E%3CfeGaussianBlur stdDeviation='3.531'/%3E%3C/filter%3E%3C/defs%3E%3Cpath fill='%23b3b3b3' d='m54.532 138.45 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.523h.023c33.707 0 61.139-27.426 61.153-61.135.006-16.335-6.349-31.696-17.895-43.251A60.75 60.75 0 0 0 87.94 25.983c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.558zm-40.811 23.544L24.16 123.88c-6.438-11.154-9.825-23.808-9.821-36.772.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954zm0 0' filter='url(%23a)'/%3E%3Cpath fill='%23fff' d='m12.966 161.238 10.439-38.114a73.42 73.42 0 0 1-9.821-36.772c.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954z'/%3E%3Cpath fill='url(%23linearGradient1780)' d='M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.559 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.524h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.929z'/%3E%3Cpath fill='url(%23b)' d='M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.313-6.179 22.558 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.517 31.126 8.523h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.928z'/%3E%3Cpath fill='%23fff' fill-rule='evenodd' d='M68.772 55.603c-1.378-3.061-2.828-3.123-4.137-3.176l-3.524-.043c-1.226 0-3.218.46-4.902 2.3s-6.435 6.287-6.435 15.332 6.588 17.785 7.506 19.013 12.718 20.381 31.405 27.75c15.529 6.124 18.689 4.906 22.061 4.6s10.877-4.447 12.408-8.74 1.532-7.971 1.073-8.74-1.685-1.226-3.525-2.146-10.877-5.367-12.562-5.981-2.91-.919-4.137.921-4.746 5.979-5.819 7.206-2.144 1.381-3.984.462-7.76-2.861-14.784-9.124c-5.465-4.873-9.154-10.891-10.228-12.73s-.114-2.835.808-3.751c.825-.824 1.838-2.147 2.759-3.22s1.224-1.84 1.836-3.065.307-2.301-.153-3.22-4.032-10.011-5.666-13.647'/%3E%3C/svg%3E">
				<?php echo esc_html( $whatsapp_btn['button_text'] ?? __( 'Whatsapp Us', 'rgbcode-authform' ) ); ?>
			</button>
			<?php endif; ?>
			<button id="rgbcode-deposit-submit" class="rgbcode-authform-button" tabindex="7" type="submit" disabled>
				<?php echo esc_html( $args['submit'] ?? __( 'Submit', 'rgbcode-authform' ) ); ?>
			</button>
		</div>

	</form>
</div>


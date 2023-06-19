<?php
	$visibility_class = $args['visibility_class'] ?? '';
?>
<div class="rgbcode-authform-modal <?php echo esc_attr( $visibility_class ); ?>" id="rgbcode-deposit">
	<button class="rgbcode-authform-modal__close rgbcode-authform-close" type="button"></button>
	<form class="rgbcode-authform-form">

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
				<div class="rgbcode-authform-input">
					<label class="rgbcode-authform-input__label">
						<span><?php echo esc_html( $args['country'] ); ?></span>
						<select
							id="rgbcode-authform-deposit-country"
							class="rgbcode-valid"
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
								<?php echo $currencies ? esc_attr( "data-currency=$currencies" ) : ''; ?>
							><?php echo esc_html( $country ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
				</div>

				<div class="rgbcode-authform-input rgbcode-authform-input_currency">
					<label class="rgbcode-authform-input__label">
						<span><?php echo esc_html__( 'Currency', 'rgbcode-authform' ); ?></span>
						<select
							id="rgbcode-authform-deposit-currency"
							class="rgbcode-valid"
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
							type="date"
							name="birthday"
							tabindex="6"
							autocomplete="off"
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
			<button id="rgbcode-deposit-submit" class="rgbcode-authform-button" tabindex="7" type="submit" disabled>
				<?php echo esc_html( $args['submit'] ?? __( 'Submit', 'rgbcode-authform' ) ); ?>
			</button>
		</div>

	</form>
</div>


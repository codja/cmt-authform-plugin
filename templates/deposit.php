<?php
	$visibility_class = $args['visibility_class'] ?? '';
?>
<div class="rgbcode-authform-modal <?php // echo esc_attr( $visibility_class ); ?>" id="rgbcode-deposit">
	<button class="rgbcode-authform-modal__close" type="button"></button>
	<form class="rgbcode-authform-signup" id="rgbcode-deposit">

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

		<div class="rgbcode-authform-signup__inputs">

			<?php if ( ! empty( $args['country'] ) ) : ?>
				<div class="rgbcode-authform-input">
					<label class="rgbcode-authform-input__label">
						<?php echo esc_html( $args['country'] ); ?>
						<select
							name="country"
							tabindex="1"
							autocomplete="off"
							required
						></select>
					</label>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $args['city'] ) ) : ?>
			<div class="rgbcode-authform-input">
				<label class="rgbcode-authform-input__label">
					<?php echo esc_html( $args['city']['label'] ?? '' ); ?>
					<input
						type="text"
						name="city"
						maxlength="50"
						minlength="2"
						tabindex="2"
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
					<?php echo esc_html( $args['address']['label'] ?? '' ); ?>
					<input
						type="text"
						name="address"
						maxlength="50"
						minlength="2"
						tabindex="3"
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
					<?php echo esc_html( $args['postcode']['label'] ?? '' ); ?>
					<input
						type="text"
						name="postcode"
						maxlength="50"
						minlength="2"
						tabindex="4"
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
						<?php echo esc_html( $args['birthday']['label'] ?? '' ); ?>
						<input
							type="date"
							name="birthday"
							tabindex="5"
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
		<button id="rgbcode-signup-submit" class="rgbcode-authform-button" type="submit" disabled>
			<?php echo esc_html( $args['submit'] ?? __( 'Submit', 'rgbcode-authform' ) ); ?>
		</button>
	</form>
</div>


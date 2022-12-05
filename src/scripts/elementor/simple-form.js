class SimpleForm extends elementorModules.frontend.handlers.Base {

	getDefaultSettings() {
		return {
			selectors: {
				form: '.rgbcode-simple-form',
				firstname: '.rgbcode-simple-form__input[name=firstname]',
				lastname: '.rgbcode-simple-form__input[name=lastname]'
			}
		};
	}

	getDefaultElements() {
		const selectors = this.getSettings( 'selectors' );
		return {
			$form: this.$element.find( selectors.form ),
			$firstname: this.$element.find( selectors.firstname ),
			$lastname: this.$element.find( selectors.lastname ),
		};
	}

	bindEvents() {
		this.elements.$form.on( 'submit', this.openSignup.bind( this ) );
	}

	openSignup( event ) {
		event.preventDefault();
		const authformContainer = jQuery( '#rgbcode-authform' );
		const signUp = jQuery( '#rgbcode-signup' );

		if ( ! authformContainer || ! signUp ) {
			return;
		}

		const hideClass = 'rgbcode-hidden';
		const signUpFirstname = signUp.find( 'input[name=firstname]' );
		const signUpLastname = signUp.find( 'input[name=lastname]' );

		authformContainer.removeClass( hideClass );
		signUp.removeClass( hideClass );

		signUpFirstname.val( this.elements.$firstname.val() );
		signUpLastname.val( this.elements.$lastname.val() );
	}

}

jQuery( window ).on( 'elementor/frontend/init', () => {
	const addHandler = ( $element ) => {
		elementorFrontend.elementsHandler.addHandler( SimpleForm, {
			$element,
		} );
	};

	elementorFrontend.hooks.addAction( 'frontend/element_ready/rgbc-simple-form.default', addHandler );
} );
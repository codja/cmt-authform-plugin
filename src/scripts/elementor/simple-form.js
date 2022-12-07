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
		const isNotExistAuthform = ! authformContainer.length || ! signUp.length;

		isNotExistAuthform
			? this.showPandaForm()
			: this.showAuthform( signUp, authformContainer );
	}

	showPandaForm() {
		if ( ! window.runPlugin ) {
			return;
		}
		runPlugin( 'forexSignup' );
		const wait = setInterval( () => {
			const pandaForm = jQuery( 'signup-long' );
			if ( pandaForm.length ) {
				const firstNameInput = pandaForm.find( 'input[name=firstName]' );
				const lastNameInput = pandaForm.find( 'input[name=lastName]' );

				firstNameInput.val( this.elements.$firstname.val() );
				lastNameInput.val( this.elements.$lastname.val() );

				clearInterval( wait );
			}
		}, 500 );
	}

	showAuthform( signUp, container ) {
		const hideClass = 'rgbcode-hidden';
		const signUpFirstname = signUp.find( 'input[name=firstname]' );
		const signUpLastname = signUp.find( 'input[name=lastname]' );

		container.removeClass( hideClass );
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
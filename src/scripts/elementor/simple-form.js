class SimpleForm extends elementorModules.frontend.handlers.Base {

	onInit() {
		super.onInit();

		this.authformContainer = jQuery( '#rgbcode-authform' );
		this.signUp = jQuery( '#rgbcode-signup' );
		this.isNotExistAuthform = ! this.authformContainer.length || ! this.signUp.length;

		this.checkStateSubmit();
	}

	checkStateSubmit() {
		this.isNotExistAuthform
			? this.pandaSubmitActive()
			: this.submitActive();
	}

	submitActive() {
		this.elements.$submit.prop( 'disabled', false );
	}

	pandaSubmitActive() {
		const wait = setInterval( () => {
			if ( window.runPlugin ) {
				this.submitActive();
				clearInterval( wait );
			}
		}, 1500 );
	}

	getDefaultSettings() {
		return {
			selectors: {
				form: '.rgbcode-simple-form',
				firstname: '.rgbcode-simple-form__input[name=firstname]',
				lastname: '.rgbcode-simple-form__input[name=lastname]',
				submit: '.rgbcode-simple-form__btn'
			}
		};
	}

	getDefaultElements() {
		const selectors = this.getSettings( 'selectors' );
		return {
			$form: this.$element.find( selectors.form ),
			$firstname: this.$element.find( selectors.firstname ),
			$lastname: this.$element.find( selectors.lastname ),
			$submit: this.$element.find( selectors.submit ),
		};
	}

	bindEvents() {
		this.elements.$form.on( 'submit', this.openSignup.bind( this ) );
	}

	openSignup( event ) {
		event.preventDefault();

		this.isNotExistAuthform
			? this.showPandaForm()
			: this.showAuthform();
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

	showAuthform() {
		const hideClass = 'rgbcode-hidden';
		const signUpFirstname = this.signUp.find( 'input[name=firstname]' );
		const signUpLastname = this.signUp.find( 'input[name=lastname]' );

		this.authformContainer.removeClass( hideClass );
		this.signUp.removeClass( hideClass );

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
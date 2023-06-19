import {Checks} from "./Checks.js";
import {CheckCreatedPass} from "./CheckCreatedPass.js";
import {PassStrengthIndicator} from "./PassStrengthIndicator.js";
import {Constants} from "../../Constants.js";


export class ValidateForm {

	/**
	 * Constructor
	 * @param formEl
	 * @param passCreate
	 */
	constructor( formEl, passCreate = false ) {
		this.form = formEl;
		this.inputs = this.form.querySelectorAll( '.rgbcode-authform-input__label input' );
		this.submit = this.form.querySelector( 'button[type=submit]' );
		this.checks = new Checks();
		this.checkStatuses = this.createCheckStatuses();
		this.passCreate = passCreate;

		if ( this.passCreate ) {
			this.passStrengthIndicator = new PassStrengthIndicator( this.form );
		}

		this.initValidate();
	}

	/**
	 * Activation of input validation depending on its type
	 */
	initValidate() {
		if ( ! this.inputs ) {
			return;
		}

		this.inputs.forEach( input => {
			switch( input.name ) {
				case 'firstname':
				case 'lastname':
					this.enableValidation( 'nameTest', input );
					this.nameHandler( input );
					break;
				case 'email':
					this.enableValidation( 'emailTest', input );
					break;
				case 'phone':
					this.checks.limitPhone( input );
					this.enableValidation( 'phoneTest', input );
					break;
				case 'password':
					this.passCreate
						? this.passListeners( input )
						: this.enableValidation( 'checkPass', input );
					break;
				case 'agree':
					this.checkAgree( input );
					break;
				case 'address':
					this.enableValidation( 'addressTest', input );
					break;
				case 'postcode':
				case 'city':
					this.enableValidation( 'textTest', input );
					break;
				case 'birthday':
					this.checkDate( input );
					break;
			}
		} );
	}

	/**
	 * A function for validating an input based on simple checks from the Checks object
	 * @param handlerName
	 * @param input
	 */
	enableValidation( handlerName, input ) {
		input.addEventListener( 'input', ( evt ) => {
				this.checkInput( input, this.checks[handlerName].call( null, evt.target.value ) );
			}
		);
	}

	/**
	 * Handler for first name and lastname, removes spaces
	 * @param input
	 */
	nameHandler( input ) {
		let timeout = null;
		input.addEventListener( 'input', () => {
			if ( timeout !== null ) {
				clearTimeout( timeout );
			}

			timeout = setTimeout( () => {
				input.value = input.value.replaceAll(/\s/g,'');
				this.checkInput( input, this.checks.nameTest( input.value ) );
			}, 1000 );
		} );
	}

	/**
	 * Adding events for entering a password, a tooltip, a password indicator
	 * @param input
	 */
	passListeners( input ) {
		const checkCreatedPass = new CheckCreatedPass( this.form )

		input.addEventListener( 'input', () => {
			const checkPass = checkCreatedPass.checkPass( input.value );
			if ( checkPass ) {
				this.checkStatuses.password = true;
				this.passStrengthIndicator.passIndicate( input.value );
				checkCreatedPass.tooltip.hideTooltip();
			} else {
				this.checkStatuses.password = false;
				this.passStrengthIndicator.resetIndicate();
				checkCreatedPass.tooltip.showTooltip();
			}
			this.checkInput( input, checkPass );
		} );

		input.addEventListener( 'focus', () => {
			if ( ! this.checkStatuses.password ) {
				checkCreatedPass.tooltip.showTooltip();
			}
		} );

		input.addEventListener( 'blur', () => {
			checkCreatedPass.tooltip.hideTooltip();
		} );
	}

	/**
	 * If all inputs in the form have been valid, unlocking the submit button
	 */
	checkPermissionSubmit() {
		if ( ! this.submit ) {
			return;
		}

		this.isFormValidate()
			? this.submit.disabled = false
			: this.submit.disabled = true;
	}

	/**
	 * Validation check of all form inputs
	 */
	isFormValidate() {
		const result = Object.values( this.checkStatuses );
		return ! result.includes( false );
	}

	/**
	 * Sets the input in a state of successful validity, hiding the error
	 * @param input
	 */
	successValid( input ) {
		this.checkStatuses[input.name] = true;
		input.classList.add( Constants.validClass );
		input.classList.remove( Constants.invalidClass )
		input.parentElement.nextElementSibling.classList.add( Constants.hideClass );
	}

	/**
	 * Sets the input to the failed validation state, shows an error
	 * @param input
	 */
	unsuccessfulValid( input ){
		this.checkStatuses[input.name] = false;
		input.classList.add( Constants.invalidClass );
		input.classList.remove( Constants.validClass )
		input.parentElement.nextElementSibling.classList.remove( Constants.hideClass );
	}

	/**
	 * Check the "agree" checkbox
	 * @param input
	 */
	checkAgree( input ) {
		input.addEventListener( 'change', ( evt ) => {
			this.checkStatuses.agree = evt.target.checked;
			this.checkPermissionSubmit();
		} );
	}

	/**
	 * We check the date so that it is more or equals than 18 years before the current date
	 * @param input
	 */
	checkDate( input ){
		input.addEventListener( 'change', ( evt ) => {
			this.checkInput( input, this.checks.checkAge( evt.target.value ) );
		} );
	}

	/**
	 * Creating an object of inputs and statuses of their state, for validation
	 */
	createCheckStatuses() {
		if ( ! this.inputs ) {
			return {};
		}

		const result = {};
		this.inputs.forEach( ( input ) => {
			result[input.name] = false;
		} );
		return result;
	}

	/**
	 * Setting the input status and general form status check
	 * @param input
	 * @param bool bool
	 */
	checkInput( input, bool = false ) {
		bool
			? this.successValid( input )
			: this.unsuccessfulValid( input );
		this.checkPermissionSubmit();
	}
}

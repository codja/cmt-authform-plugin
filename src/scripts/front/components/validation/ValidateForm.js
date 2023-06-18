import {Checks} from "./ValidateChecks.js";
import {CheckCreatedPass} from "./CheckCreatedPass.js";
import {PassStrengthIndicator} from "./PassStrengthIndicator.js";

export class ValidateForm {

	hideClass = 'rgbcode-hidden';
	validClass = 'valid';
	invalidClass = 'invalid';

	/**
	 * Constructor
	 * @param {object} formEl
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

	enableValidation( handlerName, input ) {
		input.addEventListener( 'input', ( evt ) => {
				this.checks[handlerName].call( null, evt.target.value )
					? this.successValid( input )
					: this.unsuccessfulValid( input );
				this.checkPermissionSubmit();
			}
		);
	}

	checkPermissionSubmit() {
		if ( ! this.submit ) {
			return;
		}

		this.isFormValidate()
			? this.submit.disabled = false
			: this.submit.disabled = true;
	}

	isFormValidate() {
		const result = Object.values( this.checkStatuses );
		return ! result.includes( false );
	}

	successValid( input ) {
		this.checkStatuses[input.name] = true;
		input.classList.add( this.validClass );
		input.classList.remove( this.invalidClass )
		input.parentElement.nextElementSibling.classList.add( this.hideClass );
	}

	unsuccessfulValid( input ){
		this.checkStatuses[input.name] = false;
		input.classList.add( this.invalidClass );
		input.classList.remove( this.validClass )
		input.parentElement.nextElementSibling.classList.remove( this.hideClass );
	}

	checkAgree(i) {
		i.addEventListener( 'change', ( evt ) => {
			this.checkStatuses.agree = evt.target.checked;
			this.checkPermissionSubmit();
		} );
	}

	checkDate( i ){
		i.addEventListener( 'change', ( evt ) => {
			const result = this.checks.checkAge( evt.target.value );
			result
				? this.successValid( i )
				: this.unsuccessfulValid( i );
			this.checkPermissionSubmit();
		} );
	}

	nameHandler( input ) {
		let timeout = null;
		input.addEventListener( 'input', () => {
			if ( timeout !== null ) {
				clearTimeout( timeout );
			}

			timeout = setTimeout( () => {
				input.value = input.value.replaceAll(/\s/g,'');
				this.checks.nameTest( input.value )
					? this.successValid( input )
					: this.unsuccessfulValid( input );
				this.checkPermissionSubmit();
			}, 1000 );
		} );
	}

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

	passListeners(input ) {
		const checkCreatedPass = new CheckCreatedPass( this.form )

		input.addEventListener( 'input', () => {
			if ( checkCreatedPass.checkPass( input.value ) ) {
				this.checkStatuses.password = true;
				this.successValid( input );
				this.passStrengthIndicator.passIndicate( input.value );
				checkCreatedPass.tooltip.hideTooltip();
			} else {
				this.checkStatuses.password = false;
				this.unsuccessfulValid( input );
				this.passStrengthIndicator.resetIndicate();
				checkCreatedPass.tooltip.showTooltip();
			}
			this.checkPermissionSubmit();
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
}

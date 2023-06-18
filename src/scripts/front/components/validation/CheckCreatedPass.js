import {Tooltip} from "./Tooltip.js";

export class CheckCreatedPass {

	hideClass = 'rgbcode-hidden';
	validClass = 'valid';
	count = 0;

	/**
	 * Constructor
	 * @param {object} formEl
	 */
	constructor( formEl ) {
		this.length = formEl.querySelector('#rgbc-length');
		this.lowercase = formEl.querySelector('#rgbc-lower');
		this.uppercase = formEl.querySelector('#rgbc-upper');
		this.number = formEl.querySelector('#rgbc-num');
		this.tooltip = new Tooltip( formEl.querySelector( '.rgbcode-authform-tooltip' ) );
	}

	checkPass( value ) {
		this.count = 0;

		this.checkCountChar( value )
			? this.successCheck( this.length )
			: this.failCheck( this.length );

		this.checkIfOneLowercase( value )
			? this.successCheck( this.lowercase )
			: this.failCheck( this.lowercase );

		this.checkIfOneUppercase( value )
			? this.successCheck( this.uppercase )
			: this.failCheck( this.uppercase );

		this.checkIfOneDigit( value )
			? this.successCheck( this.number )
			: this.failCheck( this.number );

		return this.count === 4;
	}

	successCheck( elem ) {
		elem.classList.add( this.validClass );
		this.count++;
	}

	failCheck( elem ) {
		elem.classList.remove( this.validClass );
		this.count--;
	}

	checkCountChar( i ){  return i.length >= 6 && i.length <= 12 };
	checkIfOneLowercase( i ) { return /[a-z]/.test( i ) };
	checkIfOneUppercase( i ){ return /[A-Z]/.test( i ) };
	checkIfOneDigit( i ) { return /[0-9]/.test( i ) };

}


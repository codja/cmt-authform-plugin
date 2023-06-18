export class PassStrengthIndicator {
	constructor( formEl ) {
		this.form = formEl;
		this.indicator = this.form.querySelector( '.rgbcode-authform-pass-strength' );
		this.msgBlock = this.form.querySelector( '.rgbcode-authform-pass-strength__msg' );
		this.msgs = JSON.parse( this.indicator.dataset.msgs );
		this.indicateClasses = Object.keys( this.msgs );
	}

	getStrengthLevelPass( value ) {
		const weakRules = this.checkRepeatedChars( value ) || ! this.checkSeriesKeyboardChars( value );
		const mediumRules = value.length > 7 && value.length <= 10 && this.checkIfTwoUppercase( value );
		const strongRules = value.length > 10 && this.checkIfTwoUppercase( value );

		switch ( true ) {
			default:
			case weakRules:
				return 'weak';
			case mediumRules:
				return 'medium';
			case strongRules:
				return 'strong';
		}
	}

	showPassStrengthLevel( level ) {
		// get all values without current level
		const anotherClasses = this.indicateClasses.filter( item => item !== level );
		// add current level classes
		this.indicator.classList.add( level );
		// remove another classes
		anotherClasses.forEach( className => this.indicator.classList.remove( className ) );
	}

	enableIndicate( level ) {
		this.showPassStrengthLevel( level );
		this.msgBlock.textContent = this.msgs[level];
	}

	passIndicate( value ) {
		// Detect and determine level of strength password
		const level = this.getStrengthLevelPass( value );
		// Fill indicator by color follow to strength level
		this.enableIndicate( level );
	}

	resetIndicate() {
		this.indicateClasses.forEach( className => this.indicator.classList.remove( className ) );
		this.msgBlock.textContent = this.msgBlock.dataset.default;
	}

	checkIfTwoUppercase( i ){ return /[A-Z][^A-Z]*[A-Z]/.test( i ) };
	checkRepeatedChars( i ) { return /([a-z])\1{2}/ig.test( i ) };

	checkSeriesKeyboardChars( s ) {
		// Check for sequential numerical characters
		for ( let i in s ) {
			if ( +s[+i+1] === +s[i]+1 &&
				+s[+i+2] === +s[i]+2 ) {
				return false;
			}
		}
		// Check for sequential alphabetical characters
		for ( let i in s ) {
			if ( String.fromCharCode(s.charCodeAt( i ) + 1 ) === s[+i+1] &&
				String.fromCharCode(s.charCodeAt( i ) + 2 ) === s[+i+2] ) {
				return false;
			}
		}
		return true;
	}

}








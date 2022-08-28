import {checkIfTwoUppercase, checkRepeatedChars, checkSeriesKeyboardChars} from "./checks";

const indicator = document.querySelector( '.rgbcode-authform-pass-strength' );
const msgBlock = document.querySelector( '.rgbcode-authform-pass-strength__msg' );
const msgs = JSON.parse( indicator.dataset.msgs );
const indicateClasses = Object.keys( msgs );

const getStrengthLevelPass = value => {
	const weakRules = checkRepeatedChars( value ) || ! checkSeriesKeyboardChars( value );
	const mediumRules = value.length > 6 && value.length <= 12 && checkIfTwoUppercase( value );
	const strongRules = value.length > 12 && checkIfTwoUppercase( value );

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

const showPassStrengthLevel = level => {
	// get all values without current level
	const anotherClasses = indicateClasses.filter( item => item !== level );
	// add current level classes
	indicator.classList.add( level );
	// remove another classes
	anotherClasses.forEach( className => indicator.classList.remove( className ) );
}

const enableIndicate = level => {
	showPassStrengthLevel( level );
	msgBlock.textContent = msgs[level];
}

export const passIndicate = value => {
	// Detect and determine level of strength password
	const level = getStrengthLevelPass( value );
	// Fill indicator by color follow to strength level
	enableIndicate( level );
}

export const resetIndicate = () => {
	indicateClasses.forEach( className => indicator.classList.remove( className ) );
	msgBlock.textContent = msgBlock.dataset.default;
}
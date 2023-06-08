import {passIndicate, resetIndicate} from "./passIndicate";
import {checkCountChar, checkIfOneDigit, checkIfOneLowercase, checkIfOneUppercase} from "./checks";
import {context} from "./validation.js";

const validClass = 'valid';
const formSignUp = document.querySelector( '.rgbcode-authform-signup' );
const tooltip = formSignUp.querySelector( '.rgbcode-authform-tooltip' );

const showTooltip = () => {
	tooltip.classList.remove( 'rgbcode-hidden' );
}

const hideTooltip = () => {
	tooltip.classList.add( 'rgbcode-hidden' );
}

export const checkPass = value => {
	const
		length = formSignUp.querySelector('#rgbc-length'),
		lowercase = formSignUp.querySelector('#rgbc-lower'),
		uppercase = formSignUp.querySelector('#rgbc-upper'),
		number = formSignUp.querySelector('#rgbc-num');
	let count = 0;

	const successCheck = ( elem ) => {
		elem.classList.add( validClass );
		count++;
	}

	const failCheck = ( elem ) => {
		elem.classList.remove( validClass );
		count--;
	}

	checkCountChar( value )
		? successCheck( length )
		: failCheck( length );

	checkIfOneLowercase( value )
		? successCheck( lowercase )
		: failCheck( lowercase );

	checkIfOneUppercase( value )
		? successCheck( uppercase )
		: failCheck( uppercase );

	checkIfOneDigit( value )
		? successCheck( number )
		: failCheck( number );

	const minValid = count === 4;

	if ( minValid ) {
		passIndicate( value );
		hideTooltip();
	} else {
		showTooltip();
		resetIndicate();
	}

	return minValid;
}

export const togglePassHelper = ( input ) => {
	input.addEventListener( 'focus', () => {
		if ( ! context.globalCheck.password ) {
			showTooltip();
		}
	} );
	input.addEventListener( 'blur', () => {
		hideTooltip();
	} );
}

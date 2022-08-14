import {passIndicate, resetIndicate} from "./passIndicate";
import {checkCountChar, checkIfOneDigit, checkIfOneLowercase, checkIfOneUppercase} from "./checks";

const validClass = 'valid';


export const checkPass = value => {
	const
		length = document.getElementById('rgbc-length'),
		lowercase = document.getElementById('rgbc-lower'),
		uppercase = document.getElementById('rgbc-upper'),
		number = document.getElementById('rgbc-num');
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
		? successCheck(lowercase )
		: failCheck( lowercase );

	checkIfOneUppercase( value )
		? successCheck(uppercase )
		: failCheck( uppercase );

	checkIfOneDigit( value )
		? successCheck( number )
		: failCheck( number );

	const minValid = count === 4;

	minValid
		? passIndicate( value )
		: resetIndicate()

	return minValid;
}

export const togglePassHelper = ( input ) => {
	input.addEventListener( 'focus', () => {
		input.parentElement.nextElementSibling.nextElementSibling.classList.remove( 'rgbcode-hidden' );
	} );
	input.addEventListener( 'blur', () => {
		input.parentElement.nextElementSibling.nextElementSibling.classList.add( 'rgbcode-hidden' );
	} );
}

const validClass = 'valid';
const checkCountChar = i => i.length >= 6 && i.length < 20;
const checkIfOneLowercase = i => /[a-z]/.test( i );
const checkIfOneUppercase = i => /[A-Z]/.test( i );
const checkIfOneDigit = i => /[0-9]/.test( i );

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

	return count === 4;
}

export const togglePassHelper = ( input ) => {
	input.addEventListener( 'focus', () => {
		input.parentElement.nextElementSibling.nextElementSibling.classList.remove( 'rgbcode-hidden' );
	} );
	input.addEventListener( 'blur', () => {
		input.parentElement.nextElementSibling.nextElementSibling.classList.add( 'rgbcode-hidden' );
	} );
}

export class Checks {
	nameTest( i ) { return /^[\u0600-\u06FFa-zA-Z]{3,40}(\s[\u0600-\u06FFa-zA-Z]{1,40})?(\s[\u0600-\u06FFa-zA-Z]{1,40})?$/.test( i ) };
	emailTest( i ) { return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.){1,2}[a-zA-Z]{2,}))$/.test( i ) };
	phoneTest( i ) { return /^[0-9]{6,}$/.test( i ) };
	textTest( i ) { return /^[^\s](?=.*[\u0600-\u06FFa-zA-Z0-9])[\u0600-\u06FFa-zA-Z0-9 ]{2,100}$/.test( i ) };
	addressTest( i ) { return /^[a-zA-Z0-9\s:#;,./"]{2,100}$/.test(i) };
	checkPass( i ) { return /^[a-zA-Z0-9]{6,}$/.test( i ) };
	limitPhone( input ) {
		const maxChars = 10;
		const limitHandler = ( evt ) => {
			const input = evt.target;
			input.value = input.value.replace( /[\D]/g, '' );
			if ( input.value.length > maxChars ) {
				input.value = input.value.substr( 0, maxChars );
			}
		};

		input.addEventListener( 'input', limitHandler );
	}
	checkCurrency( string ) { return string.length === 3 }

	checkAge( dateString ) {
		// Split the date string into day, month, and year components
		const [day, month, year] = dateString.split( '/' ).map( Number );

		// Create a Date object for the given date of birth
		const dob = new Date( year, month - 1, day ); // Month is zero-based in JavaScript
		const today = new Date();

		// Calculate the age in years
		let age = today.getFullYear() - dob.getFullYear();

		// Check if the birthday has passed this year
		const isBirthdayPassed =
			today.getMonth() > dob.getMonth() ||
			(today.getMonth()===dob.getMonth() && today.getDate() >= dob.getDate());

		if ( ! isBirthdayPassed ) {
			age--; // Decrease age by 1 if the birthday has not yet occurred this year
		}

		// Return true if age is between 18 and 100 (inclusive)
		return age >= 18 && age <= 100;
	}

}
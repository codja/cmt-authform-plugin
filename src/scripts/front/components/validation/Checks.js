export class Checks {
	nameTest( i ) { return /^[a-zA-Zء-ي]{3,50}$/.test( i ) };
	emailTest( i ) { return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.){1,2}[a-zA-Z]{2,}))$/.test( i ) };
	phoneTest( i ) { return /^[0-9]{6,}$/.test( i ) };
	textTest( i ) { return /^[^\s](?=.*[\u0600-\u06FFa-zA-Z0-9])[\u0600-\u06FFa-zA-Z0-9 ]{2,100}$/.test( i ) };
	addressTest( i ) { return /^[^\s](?=.*[\u0600-\u06FFa-zA-Z0-9])[\u0600-\u06FFa-zA-Z0-9 .\/]{2,100}$/.test( i ) };
	checkPass( i ) { return /^[a-zA-Z]{6,}$/.test( i ) };
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
	checkAge( dateString ) {
		const splitDate = dateString.split( '/' );
		// Convert the date string to a Date object
		const dob = new Date( splitDate[2], splitDate[1], splitDate[0] );
		// Calculate the age in milliseconds
		const ageInMs = Date.now() - dob.getTime();
		// Calculate the age in years
		const ageInYears = ageInMs / (1000 * 60 * 60 * 24 * 365.25);
		// Check if the age is greater than or equal to 18
		return ageInYears >= 18 && ageInYears <= 100;
	}

}
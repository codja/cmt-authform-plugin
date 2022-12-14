export const checkIfTwoUppercase = i => /[A-Z][^A-Z]*[A-Z]/.test( i );
export const checkCountChar = i => i.length >= 6 && i.length <= 12;
export const checkIfOneLowercase = i => /[a-z]/.test( i );
export const checkIfOneUppercase = i => /[A-Z]/.test( i );
export const checkIfOneDigit = i => /[0-9]/.test( i );
export const checkRepeatedChars = i => /([a-z])\1{2}/ig.test( i );
export const nameTest = i => /^[a-zA-Zء-ي]{3,50}$/.test( i );
export const emailTest = i => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test( i );
export const phoneTest = i => /^[0-9]{6,}$/.test( i );
export const checkSeriesKeyboardChars = s => {
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
export const limitPhone = ( input ) => {
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

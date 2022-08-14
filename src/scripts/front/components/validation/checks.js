export const checkIfTwoUppercase = i => /[A-Z][^A-Z]*[A-Z]/.test( i );
export const checkCountChar = i => i.length >= 6 && i.length < 20;
export const checkIfOneLowercase = i => /[a-z]/.test( i );
export const checkIfOneUppercase = i => /[A-Z]/.test( i );
export const checkIfOneDigit = i => /[0-9]/.test( i );
export const checkRepeatedChars = i => /([a-z])\1/ig.test( i );
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

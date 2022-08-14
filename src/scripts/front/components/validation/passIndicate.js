const getStrengthLevelPass = value => {
	//return string(weak, medium, strong)
	return 'weak';
}

const enableIndicate = level => {
	const indicator = document.querySelector( '.rgbcode-authform-pass-strength' );
	const msgBlock = document.querySelector( '.rgbcode-authform-pass-strength__msg' );
	const msgs = JSON.parse( indicator.dataset.msgs );

	indicator.classList.add( level );
	msgBlock.textContent = msgs[level];
	// switch ( level ) {
	// 	case 'weak':
	// 		break;
	// 	case 'medium':
	// 		break;
	// 	case 'strong':
	// 		break;
	// }
	// operation with classes
	// Show Message
}

export const passIndicate = value => {
	// Detect and determine level of strength password
	const level = getStrengthLevelPass( value );
	// Fill indicator by color follow to strength level
	enableIndicate( level );
}
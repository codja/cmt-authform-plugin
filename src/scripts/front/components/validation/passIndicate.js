const indicator = document.querySelector( '.rgbcode-authform-pass-strength' );
const msgBlock = document.querySelector( '.rgbcode-authform-pass-strength__msg' );
const msgs = JSON.parse( indicator.dataset.msgs );

const getStrengthLevelPass = value => {
	//return string(weak, medium, strong)
	return 'weak';
}

const showPassStrengthLevel = level => {
	// get keys from msgs
	const indicateClasses = Object.keys( msgs );
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
	const indicateClasses = Object.keys( msgs );
	indicateClasses.forEach( className => indicator.classList.remove( className ) );
	msgBlock.textContent = msgBlock.dataset.default;
}
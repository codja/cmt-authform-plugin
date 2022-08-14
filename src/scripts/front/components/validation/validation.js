// string = string.replace(/\s\s+/g, ' '); str = str.replace(/\s{2,}/g,' ');

import {checkPass, togglePassHelper} from "./validationPass";

const fullNameTest = i =>
	/^[a-zA-Zء-ي]{2,50}\s[a-zA-Zء-ي]{2,50}$/.test( i );

const emailTest = i =>
	/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test( i );

const phoneTest = i =>
	/^[0-9]{6,12}$/.test( i );

const context = {
	fullNameTest,
	emailTest,
	phoneTest,
	checkPass
};

function execFn(fnName, ctx )
{
	const args = Array.prototype.slice.call(arguments, 2);
	return ctx[fnName].apply(ctx, args);
}

const hideError = input => {
	input.classList.add( 'valid' );
	input.classList.remove( 'invalid' )
	input.parentElement.nextElementSibling.classList.add( 'rgbcode-hidden' );
}

const showError = input => {
	input.classList.add( 'invalid' );
	input.classList.remove( 'valid' )
	input.parentElement.nextElementSibling.classList.remove( 'rgbcode-hidden' );
}

const enableValidation = ( handlerName, input ) => {
	input.addEventListener( 'keyup', ( evt ) => {
			execFn( handlerName, context, evt.target.value )
				? hideError( input )
				: showError( input )
		}
	);
}

const inputs = document.querySelectorAll( '.rgbcode-authform-input__label input' );

export function initValidate() {
	inputs.forEach( input => {
		switch( input.name ) {
			case 'full_name':
				enableValidation( 'fullNameTest', input );
			break;
			case 'email':
				enableValidation( 'emailTest', input );
			break;
			case 'phone':
				enableValidation( 'phoneTest', input )
			break;
			case 'password':
				enableValidation( 'checkPass', input )
				togglePassHelper( input );
			break;
		}
	} );
}

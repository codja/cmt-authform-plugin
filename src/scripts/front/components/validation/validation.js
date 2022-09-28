import {checkPass, togglePassHelper} from "./validationPass";
import {emailTest, nameTest, limitPhone, phoneTest} from "./checks";

const submit = document.getElementById( 'rgbcode-signup-submit' );
const context = {
	globalCheck: {
		full_name: false,
		email: false,
		phone: false,
		password: false,
		agree: false
	},
	nameTest,
	emailTest,
	phoneTest,
	checkPass
};

function execFn(fnName, ctx )
{
	const args = Array.prototype.slice.call(arguments, 2);
	return ctx[fnName].apply(ctx, args);
}

const nameHandler = ( input ) => {
	let timeout = null;
	input.addEventListener( 'input', () => {
		if ( timeout !== null ) {
			clearTimeout( timeout );
		}

		timeout = setTimeout( () => {
			input.value = input.value.replaceAll(/\s/g,'');
			input.dispatchEvent( new Event( 'input' ) );
		}, 1000 );
	} );
}

const isFormValidate = () => {
	const result = Object.values( context.globalCheck );
	return ! result.includes( false );
}

const checkPermissionSubmit = () => {
	isFormValidate()
		? submit.disabled = false
		: submit.disabled = true;
}

const checkAgree = i => {
	i.addEventListener( 'change', ( evt ) => {
		context.globalCheck.agree = evt.target.checked;
		checkPermissionSubmit();
	} );
}

const successValid = input => {
	context.globalCheck[input.name] = true;
	input.classList.add( 'valid' );
	input.classList.remove( 'invalid' )
	input.parentElement.nextElementSibling.classList.add( 'rgbcode-hidden' );
}

const unsuccessfulValid = input => {
	context.globalCheck[input.name] = false;
	input.classList.add( 'invalid' );
	input.classList.remove( 'valid' )
	input.parentElement.nextElementSibling.classList.remove( 'rgbcode-hidden' );
}

const enableValidation = ( handlerName, input ) => {
	input.addEventListener( 'input', ( evt ) => {
			execFn( handlerName, context, evt.target.value )
				? successValid( input )
				: unsuccessfulValid( input );
			checkPermissionSubmit();
		}
	);
}

const inputs = document.querySelectorAll( '.rgbcode-authform-input__label input' );

export function initValidate() {
	inputs.forEach( input => {
		switch( input.name ) {
			case 'firstname':
			case 'lastname':
				enableValidation( 'nameTest', input );
				nameHandler( input );
			break;
			case 'email':
				enableValidation( 'emailTest', input );
			break;
			case 'phone':
				limitPhone( input );
				enableValidation( 'phoneTest', input );
			break;
			case 'password':
				enableValidation( 'checkPass', input );
				togglePassHelper( input );
			break;
			case 'agree':
				checkAgree( input );
			break;
		}
	} );
}

import {checkPass, togglePassHelper} from "./validationPass";
import {emailTest, nameTest, limitPhone, phoneTest, textTest, checkAge} from "./checks";

const submitSignup = document.getElementById( 'rgbcode-signup-submit' );
const submitDeposit = document.getElementById( 'rgbcode-deposit-submit' );
export const context = {
	globalCheck: {
		signup: {
			firstname: false,
			lastname: false,
			email: false,
			phone: false,
			password: false,
			agree: false
		},
		deposit: {
			city: false,
			address: false,
			postcode: false,
			birthday: false
		}
	},
	nameTest,
	emailTest,
	phoneTest,
	checkPass,
	textTest
};

function execFn( fnName, ctx )
{
	const args = Array.prototype.slice.call( arguments, 2 );
	return ctx[fnName].apply( ctx, args );
}

const nameHandler = ( input ) => {
	let timeout = null;
	input.addEventListener( 'input', () => {
		if ( timeout !== null ) {
			clearTimeout( timeout );
		}

		timeout = setTimeout( () => {
			input.value = input.value.replaceAll(/\s/g,'');
			nameTest( input.value )
				? successValid( input, 'deposit' )
				: unsuccessfulValid( input, 'deposit' );// input.dispatchEvent( new Event( 'input' ) );
		}, 1000 );
	} );
}

const isFormValidate = ( typeForm = 'signup' ) => {
	const result = Object.values( context.globalCheck[typeForm] );
	return ! result.includes( false );
}

const checkPermissionSubmit = ( typeForm = 'signup' ) => {
	const elem = typeForm === 'signup'
		? submitSignup
		: submitDeposit;

	isFormValidate( typeForm )
		? elem.disabled = false
		: elem.disabled = true;
}

const checkAgree = i => {
	i.addEventListener( 'change', ( evt ) => {
		context.globalCheck.signup.agree = evt.target.checked;
		checkPermissionSubmit();
	} );
}

const checkDate = i => {
	i.addEventListener( 'change', ( evt ) => {
		const result = checkAge( evt.target.value );
		result
			? successValid( i, 'deposit' )
			: unsuccessfulValid( i, 'deposit' );
		checkPermissionSubmit( 'deposit' );
	} );
}

const successValid = ( input, typeForm ) => {
	context.globalCheck[typeForm][input.name] = true;
	input.classList.add( 'valid' );
	input.classList.remove( 'invalid' )
	input.parentElement.nextElementSibling.classList.add( 'rgbcode-hidden' );
}

const unsuccessfulValid = ( input, typeForm ) => {
	context.globalCheck[typeForm][input.name] = false;
	input.classList.add( 'invalid' );
	input.classList.remove( 'valid' )
	input.parentElement.nextElementSibling.classList.remove( 'rgbcode-hidden' );
}

const enableValidation = ( handlerName, input, typeForm = 'signup' ) => {
	input.addEventListener( 'input', ( evt ) => {
			execFn( handlerName, context, evt.target.value )
				? successValid( input, typeForm )
				: unsuccessfulValid( input, typeForm );
			checkPermissionSubmit( typeForm );
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
			case 'address':
			case 'postcode':
			case 'city':
				enableValidation( 'textTest', input, 'deposit' );
			break;
			case 'birthday':
				checkDate( input );
			break;
		}
	} );
}

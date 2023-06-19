import {initModal} from "./components/modal";
import {initTogglePass} from "./components/togglePassword";
import {initFlagSelect} from "./components/flagSelect";
import {initFormSubmit} from "./components/formSubmit";
import {initCountryCurrency} from "./components/countryCurrency";
import {ValidateForm} from "./components/validation/ValidateForm";

document.addEventListener( 'DOMContentLoaded', () => {
	if ( ! document.getElementById( 'rgbcode-authform' ) ) {
		return;
	}
	const modalSignUp = document.querySelector( '#rgbcode-signup' );
	const modalDeposit = document.querySelector( '#rgbcode-deposit' );

	initModal();
	new ValidateForm( modalSignUp, true );
	new ValidateForm( modalDeposit );
	initTogglePass();
	initCountryCurrency();
	initFlagSelect();
	initFormSubmit();
} );

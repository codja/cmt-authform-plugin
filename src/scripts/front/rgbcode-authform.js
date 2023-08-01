import {Modal} from "./components/Modal";
import {initTogglePass} from "./components/togglePassword";
import {initFlagSelect} from "./components/flagSelect";
import {initFormSubmit} from "./components/formSubmit";
import {initCountryCurrency} from "./components/countryCurrency";
import {ValidateForm} from "./components/validation/ValidateForm";
import customSelect from "./components/selectList.js";
import {initDatepicker} from "./components/datepicker.js";
import {Constants} from "./Constants.js";

document.addEventListener( 'DOMContentLoaded', () => {
	if ( ! document.getElementById( 'rgbcode-authform' ) ) {
		return;
	}
	const modalSignUp = document.querySelector( '#rgbcode-signup' );
	const modalDeposit = document.querySelector( '#rgbcode-deposit' );

	Constants.storage.modal = new Modal();
	if ( modalSignUp ) {
		new ValidateForm( modalSignUp, true );
	}
	if ( modalDeposit ) {
		new ValidateForm( modalDeposit );
	}
	initDatepicker();
	initTogglePass();
	initCountryCurrency();
	initFlagSelect();
	initFormSubmit();
	customSelect();
} );

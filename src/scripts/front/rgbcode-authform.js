import {initModal} from "./components/modal";
import {initValidate} from "./components/validation/validation";
import {initTogglePass} from "./components/togglePassword";
import {initFlagSelect} from "./components/flagSelect";
import {initFormSubmit} from "./components/formSubmit";
import {initCountryCurrency} from "./components/countryCurrency";

document.addEventListener( 'DOMContentLoaded', () => {
	if ( ! document.getElementById( 'rgbcode-authform' ) ) {
		return;
	}

	initModal();
	initValidate();
	initTogglePass();
	initCountryCurrency();
	initFlagSelect();
	initFormSubmit();
} );

import {initModal} from "./components/modal";
import {initValidate} from "./components/validation/validation";
import {initTogglePass} from "./components/togglePassword";
import {initFlagSelect} from "./components/flagSelect";
import {initFormSubmit} from "./components/formSubmit";

document.addEventListener( 'DOMContentLoaded', () => {
	if ( ! document.getElementById( 'rgbcode-authform' ) ) {
		return;
	}

	initModal();
	initValidate();
	initTogglePass();
	initFlagSelect();
	initFormSubmit();
} );

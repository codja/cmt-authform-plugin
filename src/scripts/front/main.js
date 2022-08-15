import {initModal} from "./components/modal";
import {initValidate} from "./components/validation/validation";
import {initTogglePass} from "./components/togglePassword";
import {initFlagSelect} from "./components/flagSelect";

document.addEventListener( 'DOMContentLoaded', () => {
	initModal();
	initValidate();
	initTogglePass();
	initFlagSelect();
} );

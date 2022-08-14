import {initModal} from "./components/modal";
import {initValidate} from "./components/validation/validation";
import {initTogglePass} from "./components/togglePassword";

document.addEventListener( 'DOMContentLoaded', () => {
	initModal();
	initValidate();
	initTogglePass();
} );

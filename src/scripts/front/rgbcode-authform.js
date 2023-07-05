import {initModal} from "./components/modal";
import {initTogglePass} from "./components/togglePassword";
import {initFlagSelect} from "./components/flagSelect";
import {initFormSubmit} from "./components/formSubmit";
import {initCountryCurrency} from "./components/countryCurrency";
import {ValidateForm} from "./components/validation/ValidateForm";
import customSelect from "./components/selectList.js";
import AirDatepicker from 'air-datepicker';
import localeEn from 'air-datepicker/locale/en';

document.addEventListener( 'DOMContentLoaded', () => {
	if ( ! document.getElementById( 'rgbcode-authform' ) ) {
		return;
	}
	const modalSignUp = document.querySelector( '#rgbcode-signup' );
	const modalDeposit = document.querySelector( '#rgbcode-deposit' );

	initModal();
	// https://air-datepicker.com/docs
	new AirDatepicker('#rgbcode-authform-birthday', {
		isMobile: true,
		autoClose: true,
		dateFormat: 'dd/MM/yyyy',
		buttons: ['today', 'clear'],
		locale: localeEn,
		onSelect( {date, formattedDate, datepicker} ) {
			datepicker.$el.dispatchEvent( new Event( 'change' ) );
		}
	});

	new ValidateForm( modalSignUp, true );
	new ValidateForm( modalDeposit );
	initTogglePass();
	initCountryCurrency();
	initFlagSelect();
	initFormSubmit();
	customSelect();
} );

import AirDatepicker from 'air-datepicker';
import localeEn from 'air-datepicker/locale/en';
import localeEs from 'air-datepicker/locale/es';
import localeAr from 'air-datepicker/locale/ar';
import {Constants} from "../Constants.js";

export function initDatepicker( selector = '#rgbcode-authform-birthday' ) {
	if ( typeof AirDatepicker === 'undefined' ) {
		return;
	}

	const inputElement = document.querySelector(selector);
	if ( ! inputElement ) {
		return;
	}

	/**
	 * Determines the locale for the datepicker based on the current language setting.
	 *
	 * @returns {object} - The locale object for AirDatepicker.
	 */
	const getLocale = () => {
		if ( ! rgbcode_authform ) {
			return localeEn;
		}

		const locales = {
			es: localeEs,
			ar: localeAr,
		};

		return locales[ rgbcode_authform.lang ] || localeEn;
	};

	const currentDate = new Date();
	const minAllowedDate = new Date();
	minAllowedDate.setFullYear(currentDate.getFullYear() - 18); // Restriction 18 years ago

	// https://air-datepicker.com/docs
	Constants.storage.dp = new AirDatepicker(selector, {
		isMobile: true,
		autoClose: true,
		dateFormat: 'dd/MM/yyyy',
		buttons: ['today', 'clear'],
		locale: getLocale(),
		startDate: minAllowedDate, // Set the start date to the minimum age
		maxDate: minAllowedDate, // We prohibit the selection of dates under 18 years old
		onSelect({ date, formattedDate, datepicker }) {
			datepicker.$el.dispatchEvent(new Event('change'));
		}
	});
}
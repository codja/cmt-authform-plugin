import AirDatepicker from 'air-datepicker';
import localeEn from 'air-datepicker/locale/en';
import localeEs from 'air-datepicker/locale/es';
import localeAr from 'air-datepicker/locale/ar';
import {Constants} from "../Constants.js";

export function initDatepicker() {
	const getLocale = () => {
		if ( ! rgbcode_authform ) {
			return localeEn;
		}

		switch ( rgbcode_authform.lang ) {
			case 'es':
				return localeEs;
			case 'ar':
				return localeAr;
			default:
				return localeEn;
		}
	}
	// https://air-datepicker.com/docs
	Constants.storage.dp = new AirDatepicker('#rgbcode-authform-birthday', {
		isMobile: true,
		autoClose: true,
		dateFormat: 'dd/MM/yyyy',
		buttons: ['today', 'clear'],
		locale: getLocale(),
		onSelect( {date, formattedDate, datepicker} ) {
			datepicker.$el.dispatchEvent( new Event( 'change' ) );
		}
	} );
}
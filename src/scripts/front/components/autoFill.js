import {Constants} from "../Constants.js";

export function autoFill() {
	const formDeposit = document.querySelector( '#rgbcode-deposit .rgbcode-authform-form' );
	const registeredUserData = formDeposit.dataset.user ?? '';

	if ( ! registeredUserData ) {
		return;
	}

	const userData = JSON.parse( registeredUserData );

	const fillInput = ( selector, newValue, eventType = null ) => {
		if ( ! selector || ! newValue ) {
			return;
		}

		const elem = formDeposit.querySelector( selector );
		elem.value = newValue;
		if ( eventType ) {
			elem.dispatchEvent( new Event( eventType ) );
		}
	}

	const fillInputs = () => {
		for ( const property in userData ) {
			const newValue = userData[property];

			if ( ! newValue ) {
				continue;
			}

			switch ( property ) {
				case 'email':
					Constants.storage.clientEmail = newValue;
				break;
				case 'iso':
					fillInput( '#rgbcode-authform-deposit-country', newValue, 'change' );
				break;
				case 'base_currency':
					const currencySelect = formDeposit.querySelector( '#rgbcode-authform-deposit-currency' );
					setTimeout( () => {
						currencySelect.value = newValue;
					}, 1000 );
				break;
				case 'birth_date':
					Constants.storage.dp.selectDate( newValue );
				break;
				case 'city':
					fillInput( '[name=city]', newValue, 'input' );
				break;
				case 'address':
					fillInput( '[name=address]', newValue, 'input' );
				break;
				case 'post_code':
					fillInput( '[name=postcode]', newValue, 'input' );
				break;
			}
		}
	}
	fillInputs();
	Constants.storage.modal.autoOpen();
}

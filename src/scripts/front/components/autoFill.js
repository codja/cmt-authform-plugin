import {Constants} from "../Constants.js";

export function autoFill() {
	const formDeposit = document.querySelector( '#rgbcode-deposit .rgbcode-authform-form' );
	if ( ! formDeposit ) {
		return;
	}

	const registeredUserData = formDeposit.dataset.user ?? '';
	const params = new URLSearchParams( document.location.search );
	let action = params.get( 'action' );
	action = action && action === 'personDetailsForm' ? 'forexSignup' : false;

	if ( registeredUserData ) {
		const userData = JSON.parse( registeredUserData );
		action = 'personDetailsForm';

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
					case 'customer_id':
						Constants.storage.customerID = newValue;
						break;
					case 'iso':
						fillInput( '#rgbcode-authform-deposit-country', newValue, 'change' );
						break;
					case 'base_currency':
						const currencySelect = formDeposit.querySelector( '#rgbcode-authform-deposit-currency' );
						setTimeout( () => {
							currencySelect.value = newValue;
							currencySelect.dispatchEvent( new Event( 'change' ) );
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
	}

	if ( action ) {
		Constants.storage.modal.autoOpen( action, true );
	}
}

import {postData} from "./utils.js";

export function initFlagSelect() {
	const modalSignUp = document.querySelector( '#rgbcode-signup' );

	if ( ! modalSignUp ) {
		return;
	}

	const flagInput = modalSignUp.querySelector( '.rgbcode-authform-flag-input' );

	if ( ! flagInput ) {
		return;
	}

	const fillFlagInput = ( data ) => {
		const telephoneCode = flagInput.querySelector( '.rgbcode-authform-flag-input__code' );
		const flagImg = flagInput.querySelector( '.rgbcode-authform-flag-input__flag' );
		flagImg.src = data.src;
		telephoneCode.dataset.iso = data.iso;
		telephoneCode.textContent = data.code;
	}

	const chooseCountryDeposit = ( country ) => {
		const countrySelect = document.getElementById( 'rgbcode-authform-deposit-country' );
		countrySelect.value = country;
		countrySelect.dispatchEvent( new Event( 'change' ) );
	}

	const notAllowedMsg = modalSignUp.querySelector( '.rgbcode-authform-message' );
	postData( '/wp-json/rgbcode/v1/detect_location', {}, 'GET' )
		.then( response => {
			if ( response.success ) {
				if ( response.data.not_allowed ) {
					notAllowedMsg.classList.remove( 'rgbcode-hidden' );
				}
				fillFlagInput( response.data.country );
				chooseCountryDeposit( response.data.country.iso );
			}
		} )
		.catch( ( error ) => {
			console.error('Error:', error);
		} );

	flagInput.addEventListener( 'click', () => {
		const select = flagInput.querySelector( '.rgbcode-authform-flag-input__select' );
		select.classList.toggle( 'rgbcode-hidden' );
		modalSignUp.classList.toggle( 'rgbcode-authform-modal_overflow' );
	} );

	const options = flagInput.querySelectorAll( '.rgbcode-authform-flag-input__option' );
	if ( options ) {
		options.forEach( option => {
			option.addEventListener( 'click', () => {
				fillFlagInput( option.dataset );
				chooseCountryDeposit( option.dataset.iso );
			} );
		} )
	}
}
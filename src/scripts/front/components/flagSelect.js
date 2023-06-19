import {postData} from "./utils.js";
import {Constants} from "../Constants.js";

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
				if ( response.data.not_allowed && notAllowedMsg ) {
					notAllowedMsg.classList.remove( Constants.hideClass );
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
		select.classList.toggle( Constants.hideClass );
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
import {postData} from "./utils.js";

const modal = document.querySelector( '.rgbcode-authform-modal' );
const notAllowedMsg = modal.querySelector( '.rgbcode-authform-message' );
const flagInput = modal.querySelector( '.rgbcode-authform-flag-input' );
const select = flagInput.querySelector( '.rgbcode-authform-flag-input__select' );
const options = flagInput.querySelectorAll( '.rgbcode-authform-flag-input__option' );
const flagImg = flagInput.querySelector( '.rgbcode-authform-flag-input__flag' );
const telephoneCode = flagInput.querySelector( '.rgbcode-authform-flag-input__code' );
const countrySelect = document.getElementById( 'rgbcode-authform-deposit-country' );

const fillFlagInput = ( data ) => {
	flagImg.src = data.src;
	telephoneCode.dataset.iso = data.iso;
	telephoneCode.textContent = data.code;
}

const chooseCountryDeposit = ( country ) => {
	countrySelect.value = country;
	countrySelect.dispatchEvent( new Event( 'change' ) );
}

export function initFlagSelect() {

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
		select.classList.toggle( 'rgbcode-hidden' );
		modal.classList.toggle( 'rgbcode-authform-modal_overflow' );
	} );

	options.forEach( option => {
		option.addEventListener( 'click', () => {
			fillFlagInput( option.dataset );
			chooseCountryDeposit( option.dataset.iso );
		} );
	} )
}
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
		const modalDeposit = document.querySelector( '#rgbcode-deposit' );
		if ( ! modalDeposit ) {
			return;
		}

		const countrySelect = modalDeposit.querySelector( '#rgbcode-authform-deposit-country' );
		if ( ! countrySelect ) {
			return;
		}

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
				Constants.storage.modal.autoOpen();
			}
		} )
		.catch( ( error ) => {
			console.error('Error:', error);
		} );

	const select = flagInput.querySelector( '.rgbcode-authform-flag-input__select' );
	flagInput.addEventListener( 'click', () => {
		if ( ! flagInput.classList.contains( 'opened' ) ) {
			select.classList.remove( Constants.hideClass );
			modalSignUp.classList.toggle( 'rgbcode-authform-modal_overflow' );
			flagInput.classList.add( 'opened' );
		}
	} );

	const options = flagInput.querySelectorAll( '.rgbcode-authform-flag-input__option' );
	const search = select.querySelector( '[name=search]' );

	if ( options ) {
		options.forEach( option => {
			option.addEventListener( 'click', ( evt ) => {
				evt.stopPropagation();
				fillFlagInput( option.dataset );
				chooseCountryDeposit( option.dataset.iso );
				select.classList.add( Constants.hideClass );
				flagInput.classList.remove( 'opened' );
				modalSignUp.classList.toggle( 'rgbcode-authform-modal_overflow' );
				search.value = '';
				search.dispatchEvent( new Event( 'input' ) );
			} );
		} )

		search.addEventListener( 'input', ( e ) => {
			const searchText = e.target.value.toLowerCase();
			options.forEach( ( item, index ) => {
				item.textContent.toLowerCase().includes( searchText )
					? item.classList.remove( Constants.hideClass )
					: item.classList.add( Constants.hideClass );
			} );
		} );
	}

	const closeBtn = select.querySelector( '.rgbcode-authform-close' );
	closeBtn.addEventListener( 'click', ( evt ) => {
		evt.stopPropagation();
		select.classList.add( Constants.hideClass );
		flagInput.classList.remove( 'opened' );
		modalSignUp.classList.toggle( 'rgbcode-authform-modal_overflow' );
	} );

}
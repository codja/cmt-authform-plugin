import {getCookie, postData, serializeArray, setCookie} from "./utils";
import {Constants} from "../Constants.js";

export function initFormSubmit() {

	const modalSignUp = document.querySelector( '#rgbcode-signup' );
	if ( modalSignUp ) {
		const formSignUp = modalSignUp.querySelector( '.rgbcode-authform-form' );
		const phoneCountry = formSignUp.querySelector( '.rgbcode-authform-flag-input__code' );
		const errorBlockSignUp = formSignUp.querySelector( '.rgbcode-authform-input__error_submit' );

		formSignUp.addEventListener( 'submit', ( evt ) => {
			evt.preventDefault();

			const data = serializeArray( formSignUp );
			const referralFromCookie = getCookie('referral_params');
			const submitter = evt.submitter ?? formSignUp.querySelector( '.rgbcode-authform-button' );
			data.phonecountry = phoneCountry.textContent.trim();
			data.iso = phoneCountry.dataset.iso;

			if ( referralFromCookie ) {
				data.referral = referralFromCookie
					.substr( 1 )
					.replaceAll( '&', '|' );
			}

			submitter.classList.add( 'rgbcode-authform-button_loader' );
			submitter.disabled = true;

			postData( '/wp-json/rgbcode/v1/customer', data )
				.then( data => {
					if ( data.success ) {
						Constants.storage.clientEmail = data.email;
						errorBlockSignUp.classList.add( Constants.hideClass);
						modalSignUp.remove();
						modalDeposit.classList.remove( Constants.hideClass);
						setCookie( Constants.cookieFirstStepName, true, { 'max-age': 86400 * 7 } )
						setCookie( Constants.cookieUserEmail,  data.email, { 'max-age': 86400 * 7 } )
					} else {
						errorBlockSignUp.classList.remove( Constants.hideClass );
						errorBlockSignUp.textContent = data.message ? data.message : data.data;
						submitter.classList.remove( 'rgbcode-authform-button_loader' );
						submitter.disabled = false;
					}
				} )
				.catch( ( error ) => {
					console.error('Error:', error);
				} );
		} );
	}

	const modalDeposit = document.querySelector( '#rgbcode-deposit' );
	if ( modalDeposit ) {
		const formDeposit = modalDeposit.querySelector( '.rgbcode-authform-form' );
		const errorBlockDeposit = formDeposit.querySelector( '.rgbcode-authform-input__error_submit' );

		formDeposit.addEventListener( 'submit', ( evt ) => {
			evt.preventDefault();

			const data = serializeArray( formDeposit );
			const submitter = evt.submitter ?? formDeposit.querySelector( '.rgbcode-authform-button' );
			const isWhatsAppBtn = submitter.classList.contains( 'rgbcode-authform-button_whatsapp' );
			const savedEmail = getCookie( Constants.cookieUserEmail );

			data.email = Constants.storage.clientEmail ?? savedEmail;
			submitter.classList.add( 'rgbcode-authform-button_loader' );
			submitter.disabled = true;

			const windowRef = isWhatsAppBtn
				? window.open()
				: null;

			postData( '/wp-json/rgbcode/v1/customer', data, 'PUT' )
				.then( data => {
					if ( data.success ) {
						errorBlockDeposit.classList.add( Constants.hideClass );
						if ( isWhatsAppBtn && windowRef ) {
							windowRef.location = submitter.dataset.href;
						}
						location.href = data.link;
					} else {
						errorBlockDeposit.classList.remove( Constants.hideClass );
						errorBlockDeposit.textContent = data.message ? data.message : data.data;
						submitter.classList.remove( 'rgbcode-authform-button_loader' );
						submitter.disabled = false;
					}
				} )
				.catch( ( error ) => {
					console.error('Error:', error);
				} );
		} );
	}

}

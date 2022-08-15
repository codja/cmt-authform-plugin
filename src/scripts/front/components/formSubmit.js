import {postData, serializeArray} from "./utils";

const formSignUp = document.querySelector( '.rgbcode-authform-signup' );
const phoneCountry = formSignUp.querySelector( '.rgbcode-authform-flag-input__code' );

export function initFormSubmit() {
	formSignUp.addEventListener( 'submit', ( evt ) => {
		evt.preventDefault();

		const data = serializeArray( formSignUp );
		data.phonecountry = phoneCountry.textContent.trim();
		data.iso = phoneCountry.dataset.iso;

		postData( '/wp-json/rgbcode/v1/create_account', data )
			.then( data => {
				if ( data.success ) {
					location.href = data.link;
				} else {
					const errorBlock = formSignUp.querySelector( '.rgbcode-authform-input__error_submit' );
					errorBlock.classList.remove( 'rgbcode-hidden' );
					errorBlock.textContent = data.message ? data.message : data.data;
				}
			} )
			.catch( ( error ) => {
				console.error('Error:', error);
			} );
	} );
}

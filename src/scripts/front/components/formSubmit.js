import {postData, serializeArray} from "./utils";

const formSignUp = document.querySelector( '.rgbcode-authform-signup' );
const phoneCountry = formSignUp.querySelector( '.rgbcode-authform-flag-input__code' );
const submitBtn = formSignUp.querySelector( '.rgbcode-authform-button' );
const errorBlock = formSignUp.querySelector( '.rgbcode-authform-input__error_submit' );

export function initFormSubmit() {
	formSignUp.addEventListener( 'submit', ( evt ) => {
		evt.preventDefault();

		const data = serializeArray( formSignUp );
		data.phonecountry = phoneCountry.textContent.trim();
		data.iso = phoneCountry.dataset.iso;
		submitBtn.classList.add( 'rgbcode-authform-button_loader' );

		postData( '/wp-json/rgbcode/v1/create_account', data )
			.then( data => {
				if ( data.success ) {
					location.href = data.link;
					errorBlock.classList.add( 'rgbcode-hidden' );
				} else {
					errorBlock.classList.remove( 'rgbcode-hidden' );
					errorBlock.textContent = data.message ? data.message : data.data;
					submitBtn.classList.remove( 'rgbcode-authform-button_loader' );
				}
			} )
			.catch( ( error ) => {
				console.error('Error:', error);
			} );
	} );
}

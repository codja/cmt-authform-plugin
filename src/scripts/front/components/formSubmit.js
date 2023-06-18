import {getCookie, postData, serializeArray} from "./utils";

const modalSignUp = document.querySelector( '#rgbcode-signup' );
const modalDeposit = document.querySelector( '#rgbcode-deposit' );

const formSignUp = modalSignUp.querySelector( '.rgbcode-authform-form' );
const formDeposit = modalDeposit.querySelector( '.rgbcode-authform-form' );

const phoneCountry = formSignUp.querySelector( '.rgbcode-authform-flag-input__code' );

const submitSignUpBtn = formSignUp.querySelector( '.rgbcode-authform-button' );
const submitDepositBtn = formDeposit.querySelector( '.rgbcode-authform-button' );

const errorBlockSignUp = formSignUp.querySelector( '.rgbcode-authform-input__error_submit' );
const errorBlockDeposit = formDeposit.querySelector( '.rgbcode-authform-input__error_submit' );
let context = {};

export function initFormSubmit() {
	formSignUp.addEventListener( 'submit', ( evt ) => {
		evt.preventDefault();

		const data = serializeArray( formSignUp );
		const referralFromCookie = getCookie('referral_params');
		data.phonecountry = phoneCountry.textContent.trim();
		data.iso = phoneCountry.dataset.iso;

		if ( referralFromCookie ) {
			data.referral = referralFromCookie
				.substr( 1 )
				.replaceAll( '&', '|' );
		}

		submitSignUpBtn.classList.add( 'rgbcode-authform-button_loader' );

		postData( '/wp-json/rgbcode/v1/customer', data )
			.then( data => {
				if ( data.success ) {
					context.clientEmail = data.email;
					errorBlockSignUp.classList.add( 'rgbcode-hidden' );
					modalSignUp.remove();
					modalDeposit.classList.remove( 'rgbcode-hidden' );
				} else {
					errorBlockSignUp.classList.remove( 'rgbcode-hidden' );
					errorBlockSignUp.textContent = data.message ? data.message : data.data;
					submitSignUpBtn.classList.remove( 'rgbcode-authform-button_loader' );
				}
			} )
			.catch( ( error ) => {
				console.error('Error:', error);
			} );
	} );

	formDeposit.addEventListener( 'submit', ( evt ) => {
		evt.preventDefault();

		const data = serializeArray( formDeposit );
		data.email = context.clientEmail;

		submitDepositBtn.classList.add( 'rgbcode-authform-button_loader' );

		postData( '/wp-json/rgbcode/v1/customer', data, 'PUT' )
			.then( data => {
				if ( data.success ) {
					errorBlockDeposit.classList.add( 'rgbcode-hidden' );
					location.href = data.link;
				} else {
					errorBlockDeposit.classList.remove( 'rgbcode-hidden' );
					errorBlockDeposit.textContent = data.message ? data.message : data.data;
					submitDepositBtn.classList.remove( 'rgbcode-authform-button_loader' );
				}
			} )
			.catch( ( error ) => {
				console.error('Error:', error);
			} );
	} );
}

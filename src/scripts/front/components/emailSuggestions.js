import {Hideable} from "./Hideable.js";
import {Constants} from "../Constants.js";

export function initEmailSuggestions() {
	const $email = document.querySelector( '.rgbcode-authform-input_email' );

	if ( ! $email ) {
		return;
	}

	const emailInput = $email.querySelector( 'input[type=email]' );
	const suggestions = $email.querySelector( '.rgbcode-authform-suggestions' );

	if ( ! emailInput || ! suggestions ) {
		return;
	}

	const tooltipSuggestions = new Hideable( suggestions )

	emailInput.addEventListener( 'focus', () => {
		if ( emailInput.value.length > 0 ) {
			tooltipSuggestions.show();
		}
	} );

	[...suggestions.children].forEach( ( elem ) => {
		elem.addEventListener( 'click', ( evt ) => {
			emailInput.value = elem.textContent;
			emailInput.dispatchEvent( new Event( 'input' ) );
		} );
	} );

	emailInput.addEventListener( 'input', ( evt ) => {
		if ( emailInput.value.length === 0 ) {
			tooltipSuggestions.hide();
			return;
		}

		[...suggestions.children].forEach( ( elem ) => {
			const placeholder = elem.querySelector( '.rgbcode-authform-suggestions__placeholder' );
			const value = evt.target.value;
			if ( ! value.includes( '@' ) ) {
				placeholder.textContent = value;
			} else {
				const splitString = value.split( '@' );
				const firstPart = splitString[0];
				const emailDomain = '@' + splitString[ splitString.length - 1 ];

				placeholder.textContent = firstPart;

				! elem.textContent.includes( emailDomain )
					? elem.classList.add( Constants.hideClass )
					: elem.classList.remove( Constants.hideClass );
			}
		} );
	} );

	document.addEventListener('click', ( evt ) => {
		const outsideClick = ! emailInput.contains( evt.target ) && ! suggestions.contains( evt.target );
		if ( outsideClick ) {
			tooltipSuggestions.hide();
		}
	} );

	const signupForm = document.querySelector( '.rgbcode-authform-form_signup' );
	signupForm.addEventListener( 'keyup', ( evt ) => {
		if ( evt.keyCode === 9 ) {
			const activeElement = document.activeElement;
			if ( ! activeElement.parentElement.parentElement.classList.contains( 'rgbcode-authform-input_email' ) ) {
				tooltipSuggestions.hide();
			}
		}
	} );

}

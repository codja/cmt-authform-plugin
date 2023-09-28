import {Hideable} from "./Hideable.js";
import {Constants} from "../Constants.js";

export class EmailSuggestions {

	constructor() {
		this.email = document.querySelector( '.rgbcode-authform-input_email' );

		if ( ! this.email ) {
			return;
		}

		this.emailInput = this.email.querySelector( 'input[type=email]' );
		this.suggestions = this.email.querySelector( '.rgbcode-authform-suggestions' );

		if ( ! this.emailInput || ! this.suggestions ) {
			return;
		}

		this.tooltipSuggestions = new Hideable( this.suggestions )

		this.bindEvents();
	}

	bindEvents() {
		this.tabHandler();
		this.suggestionsHandler();
		this.emailInputHandler();
	}

	tabHandler() {
		const signupForm = document.querySelector( '.rgbcode-authform-form_signup' );

		if ( ! signupForm ) {
			return;
		}

		signupForm.addEventListener( 'keyup', ( evt ) => {
			if ( evt.keyCode === 9 ) {
				const activeElement = document.activeElement;
				if ( ! activeElement.parentElement.parentElement.classList.contains( 'rgbcode-authform-input_email' ) ) {
					this.tooltipSuggestions.hide();
				}
			}
		} );
	}

	suggestionsHandler() {
		[...this.suggestions.children].forEach( ( elem ) => {
			elem.addEventListener( 'click', ( evt ) => {
				this.emailInput.value = elem.textContent;
				this.emailInput.dispatchEvent( new Event( 'input' ) );
			} );
		} );

		document.addEventListener('click', ( evt ) => {
			const outsideClick = ! this.emailInput.contains( evt.target ) && ! this.suggestions.contains( evt.target );
			if ( outsideClick ) {
				this.tooltipSuggestions.hide();
			}
		} );
	}

	emailInputHandler() {
		this.emailInput.addEventListener( 'focus', () => {
			if ( this.emailInput.value.length > 0 ) {
				this.tooltipSuggestions.show();
			}
		} );

		this.emailInput.addEventListener( 'input', ( evt ) => {
			if ( this.emailInput.value.length === 0 ) {
				this.tooltipSuggestions.hide();
				return;
			}

			[...this.suggestions.children].forEach( ( elem ) => {
				const placeholder = elem.querySelector( '.rgbcode-authform-suggestions__placeholder' );
				const value = evt.target.value;
				! value.includes( '@' )
					? placeholder.textContent = value
					: this.handlerEmailDomain( elem, placeholder, value )
			} );
		} );
	}

	handlerEmailDomain( elem, placeholder, value ) {
		if ( ! elem || ! placeholder || ! value ) {
			return;
		}

		const splitString = value.split( '@' );
		const firstPart = splitString[0];
		const emailDomain = '@' + splitString[ splitString.length - 1 ];

		placeholder.textContent = firstPart;

		! elem.textContent.includes( emailDomain )
			? elem.classList.add( Constants.hideClass )
			: elem.classList.remove( Constants.hideClass );
	}
}

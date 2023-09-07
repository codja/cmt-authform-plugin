import {detectTablet} from "./utils.js";
import {Constants} from "../Constants.js";

export class Modal {

	defaultAction = 'forexSignup';

	allowedActions = {
		forexSignup: 'rgbcode-signup'
	}

	constructor() {
		this.html = document.querySelector( 'html' );
		this.modalWrap = document.querySelector( '.rgbcode-authform-back' );

		this.bindEvents();
	}

	showModal( target ) {
		this.html.style.overflow = 'hidden';
		this.modalWrap.classList.remove( Constants.hideClass );
		if ( target ) {
			let modal = this.modalWrap.querySelector( `#${target}` );
			if ( ! modal && target === this.allowedActions.forexSignup ) {
				target = 'rgbcode-deposit';
			}
			this.modalWrap.querySelector( `#${target}` ).classList.remove( Constants.hideClass );
		}
	}

	hideModal() {
		this.html.style.overflow = '';
		const allModals = this.modalWrap.querySelectorAll( '.rgbcode-authform-modal' );
		allModals.forEach( modal => {
			modal.classList.add( Constants.hideClass );
		} )
		this.modalWrap.classList.add( Constants.hideClass );
	}

	bindEvents() {
		this.openButtons();
		this.closeButtons();
		this.closeMsgButton();
	}

	openButtons() {
		const buttons = document.querySelectorAll( '.js-rgbcode-authform' );
		const signUp = document.querySelector( '.js-signup-btn' );

		if ( ! buttons.length ) {
			return;
		}

		buttons.forEach( button => {
			button.addEventListener( 'click', ( evt ) => {
				const onlyDesktop = button.dataset.onlyDesktop;
				const isLogged = signUp && signUp.classList.contains( Constants.hideClass );

				if ( ( onlyDesktop && detectTablet() ) || isLogged ) {
					return;
				}

				evt.preventDefault();
				const target = button.dataset.target;
				this.showModal( target );
			} )
		} );
	}

	closeButtons() {
		const closeButtonsInModal = this.modalWrap.querySelectorAll( '.rgbcode-authform-modal__close' );

		if ( ! closeButtonsInModal ) {
			return;
		}

		closeButtonsInModal.forEach( button => {
			button.addEventListener( 'click', () => {
				this.hideModal();
			} )
		} );
	}

	closeMsgButton() {
		const closeMsgBtn = this.modalWrap.querySelector( '.rgbcode-authform-message__close' );

		if ( ! closeMsgBtn ) {
			return
		}

		closeMsgBtn.addEventListener( 'click', ( evt ) => {
			closeMsgBtn.parentElement.classList.add( Constants.hideClass );
		} )
	}

	autoOpen( actionName = null, isDeposit = false ) {
		const params = new URLSearchParams( document.location.search );
		let action = params.get( 'action' );
		action = actionName && action ? actionName : action;

		this.allowedActions.personDetailsForm = isDeposit ? 'rgbcode-deposit' : '';

		if ( action && this.allowedActions.hasOwnProperty( action ) ) {
			this.showModal( this.allowedActions[ action ] );
		}
	}

}

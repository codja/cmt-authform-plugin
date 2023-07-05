import {detectTablet} from "./utils.js";
import {Constants} from "../Constants.js";

export function initModal() {
	const html = document.querySelector( 'html' ),
		modalWrap = document.querySelector( '.rgbcode-authform-back' );

	if ( ! modalWrap ) {
		return;
	}

	const showModal = ( target ) => {
		html.style.overflow = 'hidden';
		modalWrap.classList.remove( Constants.hideClass );
		if ( target ) {
			let modal = modalWrap.querySelector( `#${target}` );
			if ( ! modal && target === 'rgbcode-signup' ) {
				target = 'rgbcode-deposit';
			}
			modalWrap.querySelector( `#${target}` ).classList.remove( Constants.hideClass );
		}
	};

	const allModals = modalWrap.querySelectorAll( '.rgbcode-authform-modal' );
	const hideModal = () => {
		html.style.overflow = '';
		allModals.forEach( modal => {
			modal.classList.add( Constants.hideClass );
		} )
		modalWrap.classList.add( Constants.hideClass );
	};

	const buttons = document.querySelectorAll( '.js-rgbcode-authform' );
	if ( buttons.length ) {
		buttons.forEach( button => {
			button.addEventListener( 'click', ( evt ) => {
				const onlyDesktop = button.dataset.onlyDesktop;

				if ( onlyDesktop && detectTablet() ) {
					return;
				}

				evt.preventDefault();
				const target = button.dataset.target;
				showModal( target );
			} )
		} );
	}

	const buttonsInModal = modalWrap.querySelectorAll( '.rgbcode-authform-modal__close' );
	if ( buttonsInModal ) {
		buttonsInModal.forEach( button => {
			button.addEventListener( 'click', () => {
				hideModal();
			} )
		} );
	}

	const closeMsgBtn = modalWrap.querySelector( '.rgbcode-authform-message__close' );
	if ( closeMsgBtn ) {
		closeMsgBtn.addEventListener( 'click', ( evt ) => {
			closeMsgBtn.parentElement.classList.add( Constants.hideClass );
		} )
	}

}

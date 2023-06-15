import {detectTablet} from "./utils.js";

const html = document.querySelector( 'html' ),
	modalWrap = document.querySelector( '.rgbcode-authform-back' ),
	allModals = modalWrap.querySelectorAll( '.rgbcode-authform-modal' ),
	buttonsInModal = modalWrap.querySelectorAll( '.rgbcode-authform-modal__close' ),
	closeMsgBtn = modalWrap.querySelector( '.rgbcode-authform-message__close' );

const showModal = ( target ) => {
	html.style.overflow = 'hidden';
	modalWrap.classList.remove( 'rgbcode-hidden' );
	if ( target ) {
		let modal = modalWrap.querySelector( `#${target}` );
		if ( ! modal && target === 'rgbcode-signup' ) {
			target = 'rgbcode-deposit';
		}
		modalWrap.querySelector( `#${target}` ).classList.remove( 'rgbcode-hidden' );
	}
};

const hideModal = () => {
	html.style.overflow = '';
	allModals.forEach( modal => {
		modal.classList.add( 'rgbcode-hidden' );
	} )
	modalWrap.classList.add( 'rgbcode-hidden' );
};

export function initModal() {
	const buttons = document.querySelectorAll( '.js-rgbcode-authform' );

	if ( ! buttons.length ) {
		return;
	}

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

	buttonsInModal.forEach( button => {
		button.addEventListener( 'click', () => {
			hideModal();
		} )
	} );

	closeMsgBtn.addEventListener( 'click', ( evt ) => {
		closeMsgBtn.parentElement.classList.add( 'rgbcode-hidden' );
	} )
}

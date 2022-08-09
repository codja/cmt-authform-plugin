const html = document.querySelector( 'html' ),
	modalWrap = document.querySelector( '.rgbcode-authform-back' ),
	allModals = modalWrap.querySelectorAll( '.rgbcode-authform-modal' ),
	buttonsInModal = modalWrap.querySelectorAll( '.rgbcode-authform-modal__close' );

const showModal = ( target ) => {
	html.style.overflow = 'hidden';
	modalWrap.style.display = 'flex';
	if ( target ) {
		modalWrap.querySelector( `#${target}` ).style.display = 'block';
	}
};

const hideModal = () => {
	html.style.overflow = '';
	allModals.forEach( modal => {
		modal.style.display = 'none';
	} )
	modalWrap.style.display = 'none';
};

export function initModal() {
	const buttons = document.querySelectorAll( '.js-rgbcode-modal' );

	if ( ! buttons.length ) {
		return;
	}

	buttons.forEach( button => {
		button.addEventListener( 'click', ( evt ) => {
			const target = evt.target.dataset.target;
			showModal( target );
		} )
	} );
	buttonsInModal.forEach( button => {
		button.addEventListener( 'click', () => {
			hideModal();
		} )
	} );
}

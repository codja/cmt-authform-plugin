const modal = document.querySelector( '.rgbcode-authform-modal' );
const flagInput = modal.querySelector( '.rgbcode-authform-flag-input' );
const select = flagInput.querySelector( '.rgbcode-authform-flag-input__select' );
const options = flagInput.querySelectorAll( '.rgbcode-authform-flag-input__option' );
const flagImg = flagInput.querySelector( '.rgbcode-authform-flag-input__flag' );
const telephoneCode = flagInput.querySelector( '.rgbcode-authform-flag-input__code' );

export function initFlagSelect() {
	flagInput.addEventListener( 'click', () => {
		select.classList.toggle( 'rgbcode-hidden' );
		modal.classList.toggle( 'rgbcode-authform-modal_overflow' );
	} );

	options.forEach( option => {
		option.addEventListener( 'click', () => {
			flagImg.src = option.dataset.src;
			telephoneCode.dataset.iso = option.dataset.iso;
			telephoneCode.textContent = option.dataset.code;
		} );
	} )
}
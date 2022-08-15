const flagInput = document.querySelector( '.rgbcode-authform-flag-input' );
const select = flagInput.querySelector( '.rgbcode-authform-flag-input__select' );
const options = flagInput.querySelectorAll( '.rgbcode-authform-flag-input__option' );
const flagImg = flagInput.querySelector( '.rgbcode-authform-flag-input__flag' );
const telephoneCode = flagInput.querySelector( '.rgbcode-authform-flag-input__code' );

export function initFlagSelect() {
	flagInput.addEventListener( 'click', evt => {
		select.classList.toggle( 'rgbcode-hidden' );
	} );

	options.forEach( option => {
		option.addEventListener( 'click', () => {
			flagImg.src = option.dataset.src;
			telephoneCode.textContent = option.dataset.code;
		} );
	} )
}
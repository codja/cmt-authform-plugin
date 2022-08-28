const btns = document.querySelectorAll('.rgbcode-authform-pass-toggle');

export function initTogglePass() {
	btns.forEach( btn => {
		btn.addEventListener( 'click', ( evt ) => {
			btn.classList.toggle( 'rgbcode-active' );
			const passInput = btn.previousElementSibling;
			passInput.type === 'password'
				? passInput.type = 'text'
				: passInput.type = 'password';
		} )
	} );
}
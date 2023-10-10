import {Constants} from "../Constants.js";

export function initStart() {
	const startBtns = document.querySelectorAll( '.js-authform-start' );

	startBtns.forEach( btn => {
		btn.addEventListener( 'click', ( evt ) => {
			evt.preventDefault();
			Constants.storage.modal.showModal( Constants.targets.signUp )
		} )
	} );
}

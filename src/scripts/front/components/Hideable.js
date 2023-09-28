import {Constants} from "../Constants.js";

export class Hideable {

	constructor( element ) {
		this.elem = element;
	}

	show() {
		this.elem.classList.remove( Constants.hideClass );
	}

	hide() {
		this.elem.classList.add( Constants.hideClass );
	}

}
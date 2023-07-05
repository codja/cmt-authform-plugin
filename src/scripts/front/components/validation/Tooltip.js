import {Constants} from "../../Constants.js";

export class Tooltip {

	constructor( element ) {
		this.elem = element;
	}

	showTooltip() {
		this.elem.classList.remove( Constants.hideClass );
	}

	hideTooltip() {
		this.elem.classList.add( Constants.hideClass );
	}

}
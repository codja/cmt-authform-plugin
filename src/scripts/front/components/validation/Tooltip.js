export class Tooltip {

	hideClass = 'rgbcode-hidden';

	constructor( element ) {
		this.elem = element;
	}

	showTooltip() {
		this.elem.classList.remove( this.hideClass );
	}

	hideTooltip() {
		this.elem.classList.add( this.hideClass );
	}

}
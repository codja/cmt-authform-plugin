import {Constants} from "../Constants.js";

export default class Autocomplete {

	constructor(form) {
		if ( ! form ) {
			return;
		}
		this.form = form;

		this.searchInput = this.form.querySelector('.js-address-input');
		if ( ! this.searchInput ) {
			return;
		}

		this.btnShowExtraFields = this.form.querySelector('.js-show-extra-fields');

		this.init();
	}

	init() {
		this.addListeners();
	}

	addListeners() {
		if ( this.btnShowExtraFields ) {
			this.btnShowExtraFields.addEventListener('click', this.showExtraFields);
		}

		this.initAutocomplete();
	}

	initAutocomplete() {
		// check if google API is available
		if ( ! window?.google?.maps ) {
			return;
		}

		const options = {
			fields: ['address_components'],
		};

		this.initPlacesAutocomplete( this.searchInput, options );
	}

	/**
	 * Initializes places autocomplete for 'text' input.
	 * This should be called after the window has loaded.
	 * @param {HTMLInputElement} input - The DOM input element to enable autocomplete on.
	 * @returns {null|object}
	 */
	initPlacesAutocomplete = ( input = null, params = {} ) => {
		if ( ! input || ! window?.google?.maps?.places?.Autocomplete ) {
			return null;
		}

		const options = {
			types: ['address'],
			...params
		}

		const autocomplete = new google.maps.places.Autocomplete( input, options );
		if ( autocomplete ) {
			autocomplete.addListener(
				'place_changed',
				() => {
					const place = autocomplete.getPlace();
					place.address_components
						? this.fillAddressFields(place.address_components)
						: this.showExtraFields();
					this.searchInput.dispatchEvent(new Event('input'));
				}
			);
		}

		return autocomplete;
	}

	fillAddressFields(addressComponents) {
		if (!this.form || !Array.isArray(addressComponents)) {
			console.warn('Invalid form or addressComponents');
			return;
		}

		const mapping = {
			locality: 'city',
			administrative_area_level_2: 'city',
			route: 'address',
			postal_code: 'postcode',
			country: 'country'
		};

		const address = {};

		for (const component of addressComponents) {
			for (const type of component.types) {
				if (mapping[type]) {
					address[mapping[type]] = type === 'country' ? component.short_name : component.long_name;
				}
			}
		}

		const fields = {
			city: this.form.querySelector('input[name=city]'),
			address: this.form.querySelector('input[name=address]'),
			postcode: this.form.querySelector('input[name=postcode]'),
			country: this.form.querySelector('#rgbcode-authform-deposit-country')
		};

		for (const key in fields) {
			const element = fields[key];

			if (!element) {
				console.warn(`Field not found: ${key}`);
				continue;
			}

			// Set a new value or clear the field
			const newValue = address[key] || '';
			if (element.value !== newValue) {
				element.value = newValue;
				element.dispatchEvent(new Event(element.tagName === 'SELECT' ? 'change' : 'input'));
			}

			// If the field is cleared, show the hidden block
			if (!newValue) {
				const extraField = element.closest('.js-extra-field');
				if (extraField) {
					extraField.classList.remove(Constants.hideClass);
				}
			}
		}
	}

	showExtraFields(e) {
		const extraFields = this.form.querySelectorAll('.js-extra-field');
		if ( ! extraFields ) {
			return;
		}

		extraFields.forEach(field => {
			field.classList.remove(Constants.hideClass);
		});
		e.target.classList.add(Constants.hideClass);
	}
}

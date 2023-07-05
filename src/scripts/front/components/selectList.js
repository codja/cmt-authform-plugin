import {Constants} from "../Constants.js";

export default () => {
	const containers = document.querySelectorAll( '.js-select-list' );
	if ( ! containers.length ) {
		return null;
	}

	containers.forEach((container) => {
		const current = container.querySelector( '.js-select-list-current' );
		const select = container.querySelector( '.js-select-list-select' );
		const list = container.querySelector( '.js-select-list-list' );

		if ( ! current || ! select || ! list ) {
			return null;
		}

		const options = Array.from( select.options );
		if ( ! options.length ) {
			return null;
		}

		// create search input
		const searchHtml = document.createElement( 'input' );
		searchHtml.classList.add( 'rgbcode-authform-select__search' );
		searchHtml.type = 'search';
		searchHtml.autocomplete = 'off';
		searchHtml.role = 'textbox';
		list.appendChild( searchHtml );

		current.innerHTML = select.selectedOptions[0].label;

		const ul = document.createElement( 'ul' );
		ul.classList.add( 'select-list__list' )
		options.forEach((option) => {
			const li = document.createElement( 'li' );
			li.classList.add( 'select-list__item' );
			li.innerHTML = option.label;
			ul.appendChild( li );
		});
		list.appendChild( ul );

		const listItems = container.querySelectorAll( '.select-list__item' );
		listItems.forEach((item) => {
			item.addEventListener('click', () => {
				const optionToSelect = options.find( ( option) => option.label === item.textContent );

				if ( ! optionToSelect ) {
					return null;
				}

				optionToSelect.selected = true;
				select.dispatchEvent( new Event( 'change' ) );

				current.innerHTML = select.selectedOptions[0].label;
				container.classList.remove('rgbcode-active');
			});
		});

		current.addEventListener('click', () => {
			container.classList.toggle('rgbcode-active');
		});

		document.addEventListener('click', (e) => {
			if ( ! container.contains( e.target ) ) {
				container.classList.remove('rgbcode-active');
			}
		});

		const search = container.querySelector( '.rgbcode-authform-select__search' );
		search.addEventListener( 'input', ( e ) => {
			const searchText = e.target.value.toLowerCase();
			listItems.forEach( ( item, index ) => {
				item.textContent.toLowerCase().includes( searchText )
					? item.classList.remove( Constants.hideClass )
					: item.classList.add( Constants.hideClass );
			} );
		} );
	});
}

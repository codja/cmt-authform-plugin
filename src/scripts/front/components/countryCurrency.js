export function initCountryCurrency() {
	const modalDeposit = document.querySelector( '#rgbcode-deposit' );
	const countrySelect = modalDeposit.querySelector( '#rgbcode-authform-deposit-country' );
	const currencySelect = modalDeposit.querySelector( '#rgbcode-authform-deposit-currency' );
	const current = modalDeposit.querySelector( '.js-select-list-current' );

	if ( ! countrySelect || ! currencySelect ) {
		return;
	}

	countrySelect.addEventListener( 'change', () => {
		currencySelect.options.length = 0;

		const selectedOption = countrySelect.options[ countrySelect.selectedIndex ];
		let currency = selectedOption.dataset.currency ?? countrySelect.dataset.defaultCurrencies;
		currency = JSON.parse( currency );
		current.textContent = selectedOption.textContent;

		const newOptions = currency.map( ( item ) => new Option( item, item ) );
		newOptions.forEach( ( option ) => currencySelect.appendChild( option ) );
	} );
}

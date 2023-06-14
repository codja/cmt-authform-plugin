const countrySelect = document.getElementById( 'rgbcode-authform-deposit-country' );
const currencySelect = document.getElementById( 'rgbcode-authform-deposit-currency' );

export function initCountryCurrency() {
	countrySelect.addEventListener( 'change', () => {
		currencySelect.options.length = 0;

		let currency = countrySelect.options[ countrySelect.selectedIndex ].dataset.currency ?? countrySelect.dataset.defaultCurrencies;
		currency = JSON.parse( currency );

		const newOptions = currency.map( ( item ) => new Option( item, item ) );
		newOptions.forEach( ( option ) => currencySelect.appendChild( option ) );
	} );
}
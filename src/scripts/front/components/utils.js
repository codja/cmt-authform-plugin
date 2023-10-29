import 'regenerator-runtime/runtime';

export async function postData( url = '', data = {},  method = 'POST' ) {
	let init = {
		method: method,
		cache: 'no-store',
		headers: {
			'Content-Type': 'application/json',
			'X-WP-Nonce': rgbcode_authform.nonce,
		},
	}

	if ( method !== 'GET' ) {
		init.body = JSON.stringify( data );
	}

	const response = await fetch( url, init );
	return response.json();
}

export function serializeArray ( form ) {
	// Create a new FormData object
	const formData = new FormData( form );

	// Create an array to hold the name/value pairs
	const pairs = {};

	// Add each name/value pair to the array
	for ( const [ name, value ] of formData ) {
		pairs[name] = value;
	}

	return pairs;
}

export function getCookie( name ) {
	const matches = document.cookie.match(
		new RegExp(
			'(?:^|; )' +
			name.replace( /([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1' ) +
			'=([^;]*)'
		)
	);
	return matches ? decodeURIComponent( matches[ 1 ] ) : false;
}

export function setCookie(name, value, options = {}) {
	options = {
		path: '/',
		// add other defaults here if necessary
		...options
	};

	if ( options.expires instanceof Date ) {
		options.expires = options.expires.toUTCString();
	}

	let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

	for ( let optionKey in options ) {
		updatedCookie += "; " + optionKey;
		let optionValue = options[optionKey];
		if ( optionValue !== true ) {
			updatedCookie += "=" + optionValue;
		}
	}

	document.cookie = updatedCookie;
}

export function detectTablet() {
	return window.innerWidth <= 1024;
}

export async function getRefreshedNonce() {
	try {
		let response = await fetch( rgbcode_authform.url, {
			method: 'POST',
			headers: new Headers( {
				'Content-Type': 'application/x-www-form-urlencoded',
			} ),
			body: new URLSearchParams({
				action: 'authform_get_refreshed_nonce',
			} ).toString(),
			credentials: 'same-origin',
		} );

		response = await response.json();

		return response?.data?.nonce ?? '';
	} catch( e ) {
		return '';
	}
}

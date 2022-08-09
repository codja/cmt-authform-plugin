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
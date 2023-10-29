import {getRefreshedNonce} from "../utils.js";

export async function updateNonce() {
	const updatedNonce = await getRefreshedNonce();
	if ( updatedNonce ) {
		rgbcode_authform.nonce = updatedNonce;
	}

}

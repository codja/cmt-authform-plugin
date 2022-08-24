<?php

namespace Rgbcode_authform\classes\helpers;

/*
 * Class for send remote request
*/

use Rgbcode_authform\classes\core\Error;

abstract class Request_Api {

	/**
	 * Send remote request, get response
	 *
	 * @param string $url
	 * @param mixed $body
	 * @param string $method
	 * @param array $headers
	 *
	 * @return false|mixed
	 */
	public static function send_api(
		string $url,
		$body = [],
		string $method = 'GET',
		array $headers = []
	) {
		$request = wp_remote_request(
			$url,
			[
				'headers' => $headers,
				'method'  => $method,
				'body'    => $body,
				'timeout' => 90,
			],
		);
		if ( is_wp_error( $request ) ) {
			Error::instance()->log_error( 'request_api', $request->get_error_message() );
			return false;
		} else {
			return json_decode( wp_remote_retrieve_body( $request ), true );
		}
	}

	public static function get_response_link( $url, $param ) {
		if ( ! $url ) {
			return get_home_url();
		}

		if ( ! $param ) {
			return $url;
		}

		$base_url = wp_parse_url( $url );
		parse_str( $base_url['query'], $parameters );
		unset( $parameters[ $param ] );
		$new_query = http_build_query( $parameters );

		return $base_url['path'] . '?' . $new_query;
	}
}

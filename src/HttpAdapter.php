<?php

namespace WhoisAPIEU\Adapter;

/**
* A simple HTTP adapter
 * Does not follow PSR-7, this trade off was made to keep 
 * this package small and dependencies to a minimum
 */
class HttpAdapter {
	/**
	 * Perform a HTTP GET request and return the resulting response body
	 * 
	 * @param  string $url    Request URL
	 * @param  array $params  Associative array of keys and thier values
	 * @return array          array containing http response code and page response
	 */
	public static function get($url, $params) {
		// Get cURL resource
		$curl = \curl_init();

		// build query string
		$query = self::buildQuery($params);

		// Set some options - we are passing in a useragent too here
		\curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $url . '?' . $query,
		    CURLOPT_USERAGENT => 'WHOISAPIEU Client 1.0.0',
		    CURLOPT_HTTPGET => true
		));

		// Send the request & save response to $resp
		$response = \curl_exec($curl);

		// get response code
		$httpcode = \curl_getinfo($curl, CURLINFO_HTTP_CODE);

		// Close request to clear up some resources
		\curl_close($curl);

		return ['http_code' => $httpcode, 'result' => $response];
	}

	/**
	 * Convert an associative array of keys and thier values into 
	 * a valid query string 
	 * 
	 * @param  array $params  Associative array of keys and thier values
	 * @return string         Valid HTTP query string 
	 */
	private static function buildQuery($params) {
		return \http_build_query($params);
	}
}
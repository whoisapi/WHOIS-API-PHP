<?php

namespace WhoisAPIEU\Adapter;

use WhoisAPIEU\Adapter\HttpAdapter;
use WhoisAPIEU\Adapter\Result;

/**
 * The base API request class
 */
class Base {
	const HOST = 'https://api.whoisapi.eu';
	private $apiKey;
	protected $payload;
	const RESPONSE_PROCESSED = 200;
	const RESPONSE_UNPROCESSABLE = 422;
	const RESPONSE_COMMAND_UNKNOWN = 400;
	const RESPONSE_COMMAND_INVALID = 405;
	const RESPONSE_COMMAND_MALFORMED = 409;
	const RESPONSE_UNAUTHORIZED = 401;
	const RESPONSE_BILLING = 402;
	const RESPONSE_INTERNAL_SERVER_ERROR = 500;

	public __construct($apiKey) {
		$this->apiKey = $apiKey;
	}

	/**
	 * Set the payload for the request, e.g. the domain for 
	 * which to perform a WHOIS request
	 * 
	 * @param string $data Currently this value could be a domain name or an IP address
	 */
	public function setPayload($data) {
		$this->payload = $data;
	}

	/**
	 * Execute the API request
	 * 
	 * @return Object An instance of the Result class
	 */
	public function run() {
		$url = $this->getRequestBase();

		$rawResult = HttpAdapter::get($url, $this->payload);

		$success = true;
		if ($rawResult['http_code'] != 200) {
			$success = false;
		}

		$Result = new Result($success, $this->getMessage($rawResult['http_code']), $rawResult['result'], $rawResult['http_code']);

		return $Result;
	}
	
	/**
	 * Convert API HTTP response code into plain text explination
	 * 
	 * @param  int $code API Request HTTP response code
	 * @return string        Plain text reason for HTTP response code
	 */
	private function getMessage($code) {
		switch($code) {
			case self::PROCESSED:
				return 'The command was processed successfully.';
				break;
			case self::RESPONSE_UNPROCESSABLE:
				return 'Well formatted request however some technical issue is preventing the serving of the request, e.g. an unresponsive WHOIS server.';
				break;
			case self::RESPONSE_COMMAND_UNKNOWN:
				return 'The end-point you have sent the request to is not valid (for example, the end point should be /whois or /screenshot).';
				break;
			case self::RESPONSE_COMMAND_INVALID:
				return 'The HTTP request method used is not compatible with the selected end-point. This can occur when using POST rather than GET for example.';
				break;
			case self::RESPONSE_COMMAND_MALFORMED:
				return 'The request has been incorrectly constructed. This can occur when omitting required parameters or providing them in the wrong type.';
				break;
			case self::RESPONSE_UNAUTHORIZED:
				return 'The request was not authorised. This can occur when using an incorrect key, if the server IP is not on the account whitelist, or if the account is banned.';
				break;
			case self::RESPONSE_BILLING:
				return 'The request was refused due to a billing issue with the associated account.';
				break;
			case self::RESPONSE_INTERNAL_SERVER_ERROR:
				return 'The client did everything correctly, but we\'ve had an internal issue. ';
				break;
		}
	}
}
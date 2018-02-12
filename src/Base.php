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

		$Result = new Result();

		return $Result;
	}
}
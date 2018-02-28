<?php

namespace WhoisAPI\Adapter\Domain;

use WhoisAPI\Adapter\Base;

class Availability extends Base {
	const END_POINT = '/availability';

	/**
	 * Set the payload for the request
	 * 
	 * @param string $domain domain name such as "google.com" to check for reg availability
	 */
	public function setPayload($domain) {
		$this->payload = ['domain' => $domain];
	}

	/**
	 * Build the base API request URL for this end-point
	 * 
	 * @return String Complete API end-point URL
	 */
	protected function getRequestBase() {
		return self::HOST . self::END_POINT;
	}
}
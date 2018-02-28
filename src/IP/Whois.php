<?php

namespace WhoisAPI\Adapter\IP;

use WhoisAPI\Adapter\Base;

class Whois extends Base {
	const END_POINT = '/whois/ip';

	/**
	 * Set the payload for the request
	 * 
	 * @param string $ip IP address to lookup
	 */
	public function setPayload($ip) {
		$this->payload = ['ip_address' => $ip];
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
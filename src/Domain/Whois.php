<?php

namespace WhoisAPI\Adapter\Domain;

use WhoisAPI\Adapter\Base;

class Whois {
	const END_POINT = '/whois/domain';

	/**
	 * Set the payload for the request, e.g. the domain for 
	 * which to perform a WHOIS request
	 * 
	 * @param string $data Currently this value could be a domain name or an IP address
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
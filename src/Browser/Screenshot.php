<?php

namespace WhoisAPI\Adapter\Browser;

use WhoisAPI\Adapter\Base;

class Screenshot extends Base {
	const END_POINT = '/screenshot';

	/**
	 * Set the payload for the request
	 * 
	 * @param string $url the webaddress to capture
	 * @param integer $width      width of screenshot
	 * @param integer $height     height of screenshot
	 * @param integer $maxTimeout max time for the server to wait for the page to load before taking a screenshot
	 */
	public function setPayload($url, $width = 1200, $height = 800, $maxTimeout = 20) {
		$this->payload = [
			'url' => $url,
			'width' => $width,
			'height' => $height,
			'maxTimeout' => $maxTimeout
		];
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
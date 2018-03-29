<?php

namespace WhoisAPI\Adapter\Browser;

use WhoisAPI\Adapter\Base;

class Screenshot extends Base {
	const END_POINT = '/screenshot';
	const SETTING_TRANSPARENT_TRUE = 1;
	const SETTING_TRANSPARENT_FALSE = 0;
	const SETTING_FULLPAGE_TRUE = 1;
	const SETTING_FULLPAGE_FALSE = 0;

	/**
	 * Set the payload for the request
	 * 
	 * @param string $url the webaddress to capture
	 * @param integer $width      width of screenshot
	 * @param integer $height     height of screenshot
	 * @param integer $maxTimeout max time for the server to wait for the page to load before taking a screenshot, given in seconds
	 */
	public function setPayload($url, $width = 1920, $height = 1080) {
		$this->payload = [
			'url' => $url,
			'width' => $width,
			'height' => $height
		];
	}

	/**
	 * Removes the default white background of the rendering engine. Any content on the page without a background colour will be 
	 * rendered transparent (alpha 0). Set to "true" or 1 to enable, set to "false" or 0 to disable. Only available on PNG images. 
	 * Defaults to "false" server side.
	 * 
	 * @param integer $transparent Integer from class constants such as Screenshot::SETTING_TRANSPARENT_TRUE
	 */
	public function setTransparent($transparent) {
		$this->payload['transparent'] = $transparent;
	}

	/**
	 * Set to "false" or 0 to capture only the above the fold content. Where above the fold is defined by the box specified in the width & height parameters. 
	 * Set to "true" or 1 to capture the entire page. Only available with PNG and jpeg export types. 
	 * Defaults to "false" server side.
	 * 
	 * @param integer $full_page Integer from class constants such as Screenshot::SETTING_FULLPAGE_TRUE
	 */
	public function setFullPage($full_page) {
		$this->payload['full_page'] = $full_page;
	}

	/**
	 * Specify the quality of the screen grab on a scale between 1 and 100. The higher the number the better quality the image. 
	 * Only available on jpeg files. 
	 * Defaults to 85 server side.
	 * 
	 * @param integer $quality A sliding scale of the quality of the screen capture, from 1 to 100
	 */
	public function setQuality($quality = 85) {
		if ($quality > 100 || $quality < 1) {
			$quality = 85;
		}

		$this->payload['quality'] = $quality;
	}

	/**
	 * The time expressed in seconds to wait before the screenshot is taken (even though resources have been loaded), defaults to 1 second. 
	 * Set to 0 to take the screenshot as soon as the network becomes idle.
	 * 
	 * @param integer $requestTimeout Time specified in seconds to wait to take the screenshot after all resources have been loaded
	 */
	public function setRequestTimeout($requestTimeout = 1) {
		$this->payload['request_timeout'] = $requestTimeout;
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
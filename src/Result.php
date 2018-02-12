<?php

namespace WhoisAPIEU\Adapter;

/**
 * Response capsule
 * Object representation of a HTTP response payload
 * returned upon API request complete
 */
class Result {
	private $successful;
	private $rawPayload;
	private $arrayPayload;
	private $objectPayload;
	private $responseCode;

	public __construct($successful = false, $rawPayload = null, $responseCode = -1) {
		$this->successful = $successful;
		$this->rawPayload = $rawPayload;
		$this->responseCode = $responseCode;

		if (!$this->successful || $this->rawPayload == null || $this->responseCode == -1) {
			return $this;
		}

		// make the data usable
		$this->process();
	}

	/**
	 * Process the input data into a native structured way
	 * @return void
	 */
	private function process() {
		$this->arrayPayload = json_decode($this->rawPayload, true);
		$this->objectPayload = json_decode($this->rawPayload, false);

		// turn this instance of Result into a result set
		foreach ($this->arrayPayload as $key => $value) {
		    $object->{$key} = $value;
		}
	}

	/**
	 * Check if the parent API request was successful
	 * @return boolean True on successful parent request
	 */
	public function isSuccessful() {
		return $this->successful;
	}

	/**
	 * Get the raw HTTP response payload of the parent request
	 * @return string Json encoded data string
	 */
	public function getRawData() {
		return $this->rawPayload;
	}

	/**
	 * Get the parsed and usable form of data response from the parent request
	 * @return Array PHP Array, result of json_decode on the raw response
	 */
	public function getDataArray() {
		return $this->rawPayload;
	}

	/**
	 * Get the parsed and usable form of data response from the parent request
	 * @return Array PHP Object, result of json_decode on the raw response
	 */
	public function getDataObject() {
		return $this->rawPayload;
	}
}
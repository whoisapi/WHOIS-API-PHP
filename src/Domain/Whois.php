<?php

namespace WhoisAPIEU\Adapter\Domain;

use WhoisAPIEU\Adapter\Base;

class Whois {
	const END_POINT = '/whois/domain';

	protected function getRequestBase() {
		return self::HOST . self::END_POINT;
	}
}
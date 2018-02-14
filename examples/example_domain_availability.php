<?php

use WhoisAPI\Domain\Avaliblity as DomainAvailability;
use WhoisAPI\Capsule\Result as WhoisAPIResult;

# set key for demo
define('WHOISAPIEU_PRIV_KEY', 'REPLACE WITH YOUR KEY HERE');

# domain for which to query the WHOIS API
$domain = 'jsonwhois.io';

# Create a new instance of DomainAvailability
# This is not required with each call, only the first
$DomainAvailability = new DomainAvailability(WHOISAPIEU_PRIV_KEY);

# set the domain for the query
$DomainAvailability->setPayload($domain);

# Perform the query and store the resulting object 
$Result = $DomainAvailability->run();

# check for successful execution
if (!$Result->isSuccessful()) {
	# query failed, print the reason
	echo 'Lookup failed (' . $Result->getErrorCode() . '): ' . $Result->getErrorText();
} else {
	# get the result of the successful query as an array (default) 
	$array = $Result->getData(WhoisAPIResult::TYPE_ARRAY);

	print_r($array);
}
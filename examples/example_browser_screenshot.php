<?php

use WhoisAPI\Browser\Screenshot as BrowserScreenshot;
use WhoisAPI\Capsule\Result as WhoisAPIResult;

# set key for demo
define('WHOISAPIEU_PRIV_KEY', 'REPLACE WITH YOUR KEY HERE');

# domain for which to query the WHOIS API
$domain = 'google.com';

# Create a new instance of DomainWhois
# This is not required with each call, only the first
$DomainWhois = new DomainWhois(WHOISAPIEU_PRIV_KEY);

# set the domain for the query
$DomainWhois->setPayload($domain);

# Perform the query and store the resulting object 
$Result = $DomainWhois->run();

# check for successful execution
if (!$Result->isSuccessful()) {
	# query failed, print the reason
	echo 'Lookup failed (' . $Result->getErrorCode() . '): ' . $Result->getErrorText();
} else {
	# get the result of the successful query as an array (default) 
	$array = $Result->getData(WhoisAPIResult::TYPE_ARRAY);
	
	echo 'Expiry date: ' . $array['expires'];

	print_r($array);
}
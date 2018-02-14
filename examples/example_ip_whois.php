<?php

use WhoisAPI\IP\Whois as IPWhois;
use WhoisAPI\Capsule\Result as WhoisAPIResult;

# set key for demo
define('WHOISAPIEU_PRIV_KEY', 'REPLACE WITH YOUR KEY HERE');

# domain for which to query the WHOIS API
$domain = '8.8.8.8';

# Create a new instance of IPWhois
# This is not required with each call, only the first
$IPWhois = new IPWhois(WHOISAPIEU_PRIV_KEY);

# set the domain for the query
$IPWhois->setPayload($ip);

# Perform the query and store the resulting object 
$Result = $IPWhois->run();

# check for successful execution
if (!$Result->isSuccessful()) {
	# query failed, print the reason
	echo 'Lookup failed (' . $Result->getErrorCode() . '): ' . $Result->getErrorText();
} else {
	# get the result of the successful query as an array (default) 
	$array = $Result->getData(WhoisAPIResult::TYPE_ARRAY);

	print_r($array);
}
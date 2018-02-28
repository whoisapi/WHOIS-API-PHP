<?php

require "autoload.php";

use WhoisAPI\Adapter\Domain\Whois as DomainWhois;

# set key for demo
define('WHOISAPIEU_PRIV_KEY', 'REPLACE WITH YOUR KEY HERE');

# set to true to ignore TLS errors (use only for testing)
define('WHOISAPIEU_IGNORE_CA', true);

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
	echo 'Lookup failed (' . $Result->getStatusCode() . '): ' . $Result->getStatusMessage();
} else {
	# get the result of the successful query as an array (default) 
	$dataArray = $Result->getDataArray();
	
	echo 'Expiry date (array): ' . $dataArray['expires'] . '<br>';

	$dataObject = $Result->getDataObject();
	
	echo 'Expiry date (object): ' . $dataObject->expires . '<br>';

	echo 'Expiry date (direct from $Result): ' . $Result->expires . '<br>';

	echo 'Owner Email (direct from $Result): ' . $Result->contacts->owner[0]->email . '<br>';

	echo 'Owner Email (array): ' . $dataArray['contacts']['owner'][0]['email'] . '<br>';

	echo '<br>';

	print_r($dataArray);
}
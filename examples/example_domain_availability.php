<?php

require "autoload.php";

use WhoisAPI\Adapter\Domain\Availability as DomainAvailability;

# set key for demo
define('WHOISAPIEU_PRIV_KEY', 'REPLACE WITH YOUR KEY HERE');

# set to true to ignore TLS errors (use only for testing)
define('WHOISAPIEU_IGNORE_CA', true);

# domain for which to query the WHOIS API
$domain = 'google.com';

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
	echo 'Lookup failed (' . $Result->getStatusCode() . '): ' . $Result->getStatusMessage();
} else {
	# get the result of the successful query as an array (default) 
	$dataArray = $Result->getDataArray();
	
	echo 'Is Available (array): ' . ($dataArray['is_available'] ? 'Yes' : 'No') . '<br>';

	$dataObject = $Result->getDataObject();
	
	echo 'Is Available (object): ' . ($dataObject->is_available ? 'Yes' : 'No') . '<br>';

	echo 'Is Available (direct from $Result): ' . ($Result->is_available ? 'Yes' : 'No') . '<br>';

	echo '<br>';

	var_dump($dataArray);
}
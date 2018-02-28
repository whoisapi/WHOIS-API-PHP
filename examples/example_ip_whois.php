<?php

require "autoload.php";

use WhoisAPI\Adapter\IP\Whois as IpWhois;

# set key for demo
define('WHOISAPIEU_PRIV_KEY', 'REPLACE WITH YOUR KEY HERE');

# set to true to ignore TLS errors (use only for testing)
define('WHOISAPIEU_IGNORE_CA', true);

# ip for which to query the WHOIS API
$ip = '8.8.8.8';

# Create a new instance of IpWhois
# This is not required with each call, only the first
$IpWhois = new IpWhois(WHOISAPIEU_PRIV_KEY);

# set the ip for the query
$IpWhois->setPayload($ip);

# Perform the query and store the resulting object 
$Result = $IpWhois->run();

# check for successful execution
if (!$Result->isSuccessful()) {
	# query failed, print the reason
	echo 'Lookup failed (' . $Result->getStatusCode() . '): ' . $Result->getStatusMessage();
} else {
	# get the result of the successful query as an array (default) 
	$dataArray = $Result->getDataArray();
	
	echo 'Created date (array): ' . $dataArray['created'] . '<br>';

	$dataObject = $Result->getDataObject();
	
	echo 'Created date (object): ' . $dataObject->created . '<br>';

	echo 'Created date (direct from $Result): ' . $Result->created . '<br>';

	echo 'Owner (direct from $Result): ' . $Result->contacts->owner[0]->organization . '<br>';

	echo 'Owner (array): ' . $dataArray['contacts']['owner'][0]['organization'] . '<br>';

	echo '<br>';

	print_r($dataArray);
}
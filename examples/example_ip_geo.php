<?php

require "autoload.php";

use WhoisAPI\Adapter\IP\Geo as IpGeo;

# set key for demo
define('WHOISAPIEU_PRIV_KEY', 'REPLACE WITH YOUR KEY HERE');

# set to true to ignore TLS errors (use only for testing)
define('WHOISAPIEU_IGNORE_CA', true);

# ip for which to query the WHOIS API
$ip = '82.4.135.118';

# Create a new instance of IpGeo
# This is not required with each call, only the first
$IpGeo = new IpGeo(WHOISAPIEU_PRIV_KEY);

# set the ip for the query
$IpGeo->setPayload($ip);

# Perform the query and store the resulting object 
$Result = $IpGeo->run();

# check for successful execution
if (!$Result->isSuccessful()) {
	# query failed, print the reason
	echo 'Lookup failed (' . $Result->getStatusCode() . '): ' . $Result->getStatusMessage();
} else {
	# get the result of the successful query as an array (default) 
	$dataArray = $Result->getDataArray();
	
	echo 'ISO Country code (array): ' . $dataArray['country_code'] . '<br>';

	$dataObject = $Result->getDataObject();
	
	echo 'ISO Country code (object): ' . $dataObject->country_code . '<br>';

	echo 'ISO Country code (direct from $Result): ' . $Result->country_code . '<br>';

	echo 'Demonym (direct from $Result): ' . $Result->demonym . '<br>';

	echo 'Demonym (array): ' . $dataArray['demonym'] . '<br>';

	echo '<br>';

	print_r($dataArray);
}
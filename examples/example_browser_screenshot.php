<?php

require "autoload.php";

use WhoisAPI\Adapter\Browser\Screenshot as BrowserScreenshot;

# set key for demo
define('WHOISAPIEU_PRIV_KEY', 'REPLACE WITH YOUR KEY HERE');

# set to true to ignore TLS errors (use only for testing)
define('WHOISAPIEU_IGNORE_CA', true);

# domain for which to make a screenshot
$domain = 'google.com';

# Create a new instance of BrowserScreenshot
# This is not required with each call, only the first
$BrowserScreenshot = new BrowserScreenshot(WHOISAPIEU_PRIV_KEY);

$width = 1200;
$height = 900;
# set the domain for the query
$BrowserScreenshot->setPayload($domain, $width, $height);

# Perform the query and store the resulting object 
$Result = $BrowserScreenshot->run();

# check for successful execution
if (!$Result->isSuccessful()) {
	# query failed, print the reason
	echo 'Lookup failed (' . $Result->getStatusCode() . '): ' . $Result->getStatusMessage();
} else {
	# get the result of the successful query as an array (default) 
	$dataArray = $Result->getDataArray();
	
	echo '<img src="' . $dataArray['prefix'] . $dataArray['base64'] . '" />';
}
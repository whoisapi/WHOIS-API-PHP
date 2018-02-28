# WHOIS API PHP
A lightweight wrapper written in PHP for the domain and IP Whois API provided by whoisapi.eu

## Install
The package is PSR-4 compliant, either use a package manager or a standards compliant autoloader (like the one included in the examples directory).

Via composer:
`composer require whoisapi/adapter`

## Requirements
 + API KEY (obtain your free key from https://whoisapi.eu/register)
 + PHP 5.3+
 + CURL

# Notes
We have chosen to not make use of exceptions for error communication due to their impact on speed of code execution and relative difficulty for beginners.

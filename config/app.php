<?php

return [
	'debug' => false,

	'Datasource' => [
		'driver' => "mysql",
		'host' => "localhost",
		'username' => "root",
		'password' => "",
		'database' => "",
		'port' => "3306",

		'PASS_ENC' => CRYPT_SHA256,
		'PASS_SALT' => "",
		'PASS_PEPPER' => "",
	],
	
	'Blacklists' => [
		'header' => ['login', 'register'],
		'footer' => ['login', 'register'],
	],
];

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
	],
	
	'Blacklists' => [
		'header' => ['login', 'register'],
		'footer' => ['login', 'register'],
	],
];

<?php

# Configuration
$_CONFIG = require_once($_SERVER['DOCUMENT_ROOT']."/config/app.php");
$localConfig = $_SERVER['DOCUMENT_ROOT']."/config/app.local.php";
if (file_exists($localConfig)) {
	$_CONFIG = array_merge($_CONFIG, require_once($localConfig));
}
DEFINE('_CONFIG', $_CONFIG);


# Debugging
if (_CONFIG['debug']) {
	DEFINE('PDO_DEBUG', true);
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}


# Paths
DEFINE('_PATHS', _CONFIG['Paths']);


# Pages
$_PAGES = array_diff(scandir(_PATHS['pages']), array('..', '.'));


# Files
require_once(_PATHS['inc']."/class_autoloader.inc.php");
require_once(_PATHS['inc']."/functions.inc.php");


# Session
if (session_status() === PHP_SESSION_NONE) session_start();

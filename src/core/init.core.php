<?php

# Paths
$_PATHS['pages'] = $_SERVER['DOCUMENT_ROOT']."/pages";
$_PATHS['src'] = $_SERVER['DOCUMENT_ROOT']."/src";
$_PATHS['core'] = $_PATHS['src']."/core";
$_PATHS['inc'] = $_PATHS['src']."/inc";
$_PATHS['web'] = str_replace($_SERVER['DOCUMENT_ROOT_INIT'], "", $_SERVER['DOCUMENT_ROOT']) . "/webroot";
$_PATHS['webroot'] = $_SERVER['DOCUMENT_ROOT']."/webroot";


# Pages
$_PAGES = array_diff(scandir($_PATHS['pages']), array('..', '.'));


# Configuration
$_CONFIG = require_once($_SERVER['DOCUMENT_ROOT']."/config/app.php");
$localConfig = $_SERVER['DOCUMENT_ROOT']."/config/app.local.php";
if (file_exists($localConfig)) {
	$_CONFIG = array_merge($_CONFIG, require_once($localConfig));
}
DEFINE('_CONFIG', $_CONFIG);


# Errors
DEFINE('ERRORS', array());


# Files
require_once($_PATHS['inc']."/class_autoloader.inc.php");
require_once($_PATHS['inc']."/functions.inc.php");


# Debugging
if (_CONFIG['debug']) {
	DEFINE('PDO_DEBUG', true);
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}


# Session
(session_status() == 0) ? session_start() : null;
$_SESSION['REFERER'] = '';

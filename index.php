<?php
# author @ Martan van Verseveld

# Error showing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


# Document root overwrite
$_SERVER['DOCUMENT_ROOT_INIT'] = $_SERVER['DOCUMENT_ROOT'];
$_SERVER['DOCUMENT_ROOT'] = getcwd();


# Including core
require_once($_SERVER['DOCUMENT_ROOT']."/src/core/init.core.php");


# Page handler
$page = str_replace(str_replace($_SERVER['DOCUMENT_ROOT_INIT'], "", $_SERVER['DOCUMENT_ROOT']).'/', "", $_SERVER['REQUEST_URI']);

if (!in_array($page.'.php', $_PAGES)) {
	http_response_code(404);
	return header("Location: ".str_replace($_SERVER['DOCUMENT_ROOT_INIT'], "", $_SERVER['DOCUMENT_ROOT']).'/home');
} else {
	require_once($_PATHS['inc']."/header.inc.php");
	require_once($_PATHS['pages']."/$page.php");
	require_once($_PATHS['inc']."/footer.inc.php");
}


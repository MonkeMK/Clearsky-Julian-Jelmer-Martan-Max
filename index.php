<?php
# author @ Martan van Verseveld


# Referer handling
$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];


# Document root overwrite
$_SERVER['DOCUMENT_ROOT_INIT'] = $_SERVER['DOCUMENT_ROOT'];
$_SERVER['DOCUMENT_ROOT'] = getcwd();


# Including core
require_once($_SERVER['DOCUMENT_ROOT']."/src/core/init.core.php");


# Including handlers
require_once($_SERVER['DOCUMENT_ROOT']."/src/inc/handlers.inc.php");


# Page handler
$requested = explode("?", str_replace(str_replace($_SERVER['DOCUMENT_ROOT_INIT'], "", $_SERVER['DOCUMENT_ROOT']).'/', "", $_SERVER['REQUEST_URI']));
$page = $requested[0];

if (!in_array($page.'.php', $_PAGES)) {
	http_response_code(404);
	return header("Location: ".str_replace($_SERVER['DOCUMENT_ROOT_INIT'], "", $_SERVER['DOCUMENT_ROOT']).'/home');
} else {
	require_once($_PATHS['inc']."/header.inc.php");
	require_once($_PATHS['pages']."/$page.php");
	require_once($_PATHS['inc']."/footer.inc.php");
}


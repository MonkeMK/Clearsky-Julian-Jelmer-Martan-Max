<?php
# author @ Martan van Verseveld


# Document root overwrite
$_SERVER['DOCUMENT_ROOT_INIT'] = $_SERVER['DOCUMENT_ROOT'];
$_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', getcwd());


# Including core
require_once($_SERVER['DOCUMENT_ROOT']."/src/core/init.core.php");
if (_CONFIG['debug']) {
	echo "<script>console.log(". json_encode($_SESSION) .")</script>";
}


# Including handlers
require_once($_SERVER['DOCUMENT_ROOT']."/src/inc/handlers.inc.php");


# Page handler
$requested = explode("?", str_replace(str_replace($_SERVER['DOCUMENT_ROOT_INIT'], "", $_SERVER['DOCUMENT_ROOT']).'/', "", $_SERVER['REQUEST_URI']));
$page = $requested[0];

if (!in_array($page.'.php', $_PAGES)) {
	http_response_code(404);
    Redirect::to(str_replace($_SERVER['DOCUMENT_ROOT_INIT'], "", $_SERVER['DOCUMENT_ROOT']).'/home');
}

PageRenderer::renderPage($page);


# Session
if (!isset($_SESSION['REFERER'])) $_SESSION['REFERER'] = $page;
if ($_SESSION['REFERER'] != $page) {
	$_SESSION['REFERER'] = $page;
}

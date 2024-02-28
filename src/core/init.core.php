<?php

# Paths
$_PATHS['pages'] = $_SERVER['DOCUMENT_ROOT']."/pages";
$_PATHS['src'] = $_SERVER['DOCUMENT_ROOT']."/src";
$_PATHS['core'] = $_PATHS['src']."/core";
$_PATHS['inc'] = $_PATHS['src']."/inc";
$_PATHS['relative'] = str_replace($_SERVER['DOCUMENT_ROOT_INIT'], "", $_SERVER['DOCUMENT_ROOT']);
$_PATHS['public'] = $_SERVER['DOCUMENT_ROOT']."/public";

# Pages
$_PAGES = array_diff(scandir($_PATHS['pages']), array('..', '.'));

# Files
require_once($_PATHS['inc']."/functions.inc.php");
require_once($_PATHS['inc']."/class_autoloader.inc.php");

# Session
(session_status() == 0) ? session_start() : null;
$_SESSION['REFERER'] = '';

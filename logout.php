<?php

session_start();

$_SESSION['user_id'] = null;
$_SESSION['logged_in'] = 0;

header("Location: index.php");

?>
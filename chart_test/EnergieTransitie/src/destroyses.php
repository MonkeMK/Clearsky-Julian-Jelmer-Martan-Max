<?php
unset($_SESSION['loggedin']);
session_destroy();
header("location:../index.html");
?>
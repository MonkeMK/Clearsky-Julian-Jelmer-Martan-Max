<?php

// including config
$_CONFIG = require_once("config.php");
$localConfig = "config.local.php";
if (file_exists($localConfig)) {
    $_CONFIG = array_merge($_CONFIG, require_once($localConfig));
}
DEFINE('_CONFIG', $_CONFIG);

// connection
function connection(){
    $dsn = _CONFIG['Datasource']['driver'].":host="._CONFIG['Datasource']['host'].";port="._CONFIG['Datasource']['port'].";dbname="._CONFIG['Datasource']['database'];
    $user = _CONFIG['Datasource']['username'];
    $password = _CONFIG['Datasource']['password'];

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
        return false;
    }
};

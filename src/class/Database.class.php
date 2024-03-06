<?php

class Database {
	public $pdo;

	function __construct() {
		$this->connect_db(
			_CONFIG['Datasource']['driver'], 
			_CONFIG['Datasource']['host'], 
			_CONFIG['Datasource']['username'], 
			_CONFIG['Datasource']['password'], 
			_CONFIG['Datasource']['database'], 
			_CONFIG['Datasource']['port']
		);
	}

	private function connect_db($driver, $host, $username, $password, $dbname, $port) {
		try {
			$conn = new PDO("$driver:host=$host;port=$port;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$this->pdo = $conn;
		} catch (PDOException $e) {
			die("Connection failed: " . $e->getMessage());
		}
	}

	function query($query, $params=[]) {
		try {
			$stmt = $this->pdo->prepare($query);
			$stmt->execute($params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		} catch (PDOException $e) {
			echo "[PDOException]:   ".$e->getMessage();
		}
	}
}

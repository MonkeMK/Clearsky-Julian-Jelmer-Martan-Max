<?php

class Database {
    protected $pdo;

    function __construct()
    {
        $dsn = _CONFIG['Datasource']['driver'].":host="._CONFIG['Datasource']['host'].";port="._CONFIG['Datasource']['port'].";dbname="._CONFIG['Datasource']['database'];
        $user = _CONFIG['Datasource']['username'];
        $password = _CONFIG['Datasource']['password'];
    
        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
            return false;
        }
    
        return true;
    }
    
    public function getConnection()
    {
        return $this->pdo;
    }

    public function stopConnection() {
        $this->pdo = null;
        return $this->pdo === null;
    }

	public function query($query, $params=[]) {
		try {
			$stmt = $this->pdo->prepare($query);
			$stmt->execute($params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		} catch (PDOException $e) {
			echo "[PDOException]:   ".$e->getMessage();
		}
	}

    public function buildWhereClause($conditions): string
    {
        $conditions = DataProcessor::sanitizeData($conditions);
        $where = '';
    
        if (!empty($conditions)) {
            $where = 'WHERE ';
            $placeholders = [];
    
            foreach ($conditions as $key => $value) {
                $placeholders[] = "$key = '$value'";
            }
    
            $where .= implode(' AND ', $placeholders);
        }
    
        return $where;
    }
}

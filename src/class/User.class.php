<?php

class User 
{
    private static $dbh;

    public static function initialize(): void
    {
		self::$dbh = new Database();
    }

    public static function create($data): bool 
    {
        $data = DataProcessor::sanitizeData($data);

        // Hash password
        $hashed_passwd = password_hash(_CONFIG['Datasource']['PASS_PEPPER'] . $data['password'] . _CONFIG['Datasource']['PASS_SALT'], _CONFIG['Datasource']['PASS_ENC']);

        // Prepare the SQL query
        $query = "
            INSERT INTO user (firstname, lastname, email, phonenumber, address, zipcode, password)
            VALUES (:firstname, :lastname, :email, :phonenumber, :address, :zipcode, :password);
        ";

        try {
            // Execute statement
            $sto = self::$dbh->getConnection()->prepare($query);
            $sto->execute([
                ':email' => $data['email'],
                ':firstname' => $data['firstname'],
                ':lastname' => $data['lastname'],
                ':phonenumber' => $data['phonenumber'],
                ':address' => $data['address'],
                ':zipcode' => $data['zipcode'],
                ':password' => $hashed_passwd
            ]);
            Session::pdoDebug("No errors.");
        } catch (PDOException $e) {
            Session::pdoDebug($e);
        }

        // Check insert success
        $insert = $sto->rowCount();
        return ($insert > 0);
    }

    public static function getUser($userId) 
    {
        $userId = DataProcessor::sanitizeData($userId);

        // Prepare the SQL query
        $userQuery = "
            SELECT `user`.id, `user`.firstname, `user`.lastname, `user`.email, `user`.phonenumber, `user`.address, `user`.zipcode
                CONCAT(`user`.firstname, ' ', `user`.lastname) as 'name'
            FROM `user`
            WHERE `user`.id = :userId;
        ";

        try {
            // Execute statement
            $sto = self::$dbh->getConnection()->prepare($userQuery);
            $sto->execute([
                ':userId' => $userId
            ]);
            Session::pdoDebug("No errors.");
        } catch (PDOException $e) {
            Session::pdoDebug($e);
        }
        $results = $sto->fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    public static function getUsers() 
    {
        // Prepare the SQL query
        $query = "
            SELECT `user`.id, `user`.firstname, `user`.lastname, `user`.email, `user`.phonenumber, `user`.address, `user`.zipcode
                CONCAT(`user`.firstname, ' ', `user`.lastname) as 'name'
            FROM `user`;
        ";

        try {
            // Execute statement
            $sto = self::$pdo->prepare($query);
            $sto->execute();
            Session::pdoDebug("No errors.");
        } catch (PDOException $e) {
            Session::pdoDebug($e);
        }

        $results = $sto->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public static function update($userId, $data): bool
    {
        $userId = DataProcessor::sanitizeData($userId);
        $data = DataProcessor::sanitizeData($data);
    
        foreach ($data as $key => $value) {    
            // Prepare the SQL query
            $query = "
                UPDATE `user`
                SET $key = :value
                WHERE id = :user_id;
            ";
    
            try {
                // Execute statement
                $sto = self::$pdo->prepare($query);
                $sto->execute([
                    ':user_id' => $userId,
                    ':value' => $value
                ]);
                Session::pdoDebug("No errors.");
            } catch (PDOException $e) {
                Session::pdoDebug($e);
            }
        }
    
        return true;
    }

    public static function updatePassword($userId, $password)
    {
        $userId = DataProcessor::sanitizeData($password);

        // Hash password
        $hashed_passwd = DataProcessor::hashPassword($password);
   
        // Prepare the SQL query
        $query = "
            UPDATE `user`
            SET password = :value
            WHERE id = :user_id;
        ";

        try {
            // Execute statement
            $sto = self::$pdo->prepare($query);
            $sto->execute([
                ':user_id' => $userId,
                ':value' => $hashed_passwd
            ]);
            Session::pdoDebug("No errors.");
        } catch (PDOException $e) {
            Session::pdoDebug($e);
        }
    }
}

User::initialize();

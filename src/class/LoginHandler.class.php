<?php

class LoginHandler extends Handler
{
    public static function processForm($postData): bool
    {
        $postData = DataProcessor::sanitizeData($postData);

        if (
            !DataProcessor::validateFields($postData, ['email', 'password'])
            || !DataProcessor::validateType([$postData['email'] => FILTER_VALIDATE_EMAIL])
            || !DataProcessor::validateType([$postData['password'] => FILTER_VALIDATE_REGEXP])
        ) {
            return parent::handleError("LOGIN_ERROR", "An error occured, try again later.", "login");
        }

        if (
            !DataProcessor::registeredValue('user', ['email' => $postData['email']])
            || !self::verifyPassword($postData)
        ) {
            return parent::handleError("LOGIN_ERROR", "EMail or password incorrect.", "login");
        }

        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['user'] = self::setSession($postData['email']);
		$_SESSION['logged_in'] = true;

        parent::handleError("LOGIN_ERROR", "Logged in.", "home");
        return true;
    }

    protected static function verifyPassword($data): bool
    {
		$dbh = new Database();

        $query = "
            SELECT `user`.password
            FROM `user`
            WHERE `user`.email = :email;
        ";

		$results = $dbh->query($query, [':email' => $data['email']])[0];

        $passed = password_verify(_CONFIG['Datasource']['PASS_PEPPER'] . $data['password'] . _CONFIG['Datasource']['PASS_SALT'], $results['password']);
        return $passed;
    }

    private static function setSession($userEmail): array
    {
		$dbh = new Database();

        $query = "
            SELECT `user`.*
            FROM `user`
            WHERE `user`.email = :email;
        ";

		$fetch = $dbh->query($query, [':email' => $userEmail])[0];

        $results = [
            'id' => $fetch['id'],
            'email' => $fetch['email'],
            'firstname' => $fetch['firstname'],
            'lastname' => $fetch['lastname'],
            'role' => $fetch['role']
        ];

        return $results;
    }
}

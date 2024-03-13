<?php

class RegistrationHandler extends Handler
{
    public static function processForm($postData): bool
    {
        $postData = DataProcessor::sanitizeData($postData);

        if (
            !DataProcessor::validateFields($postData, ['email', 'firstname', 'lastname', 'address', 'zipcode', 'phonenumber', 'password', 'password-confirm'])
            || !DataProcessor::validateType([$postData['firstname'] => FILTER_VALIDATE_REGEXP])
            || !DataProcessor::validateType([$postData['lastname'] => FILTER_VALIDATE_REGEXP])
            || !DataProcessor::validateType([$postData['email'] => FILTER_VALIDATE_EMAIL])
            || !DataProcessor::validateType([$postData['address'] => FILTER_VALIDATE_REGEXP])
            || !DataProcessor::validateType([$postData['zipcode'] => FILTER_VALIDATE_REGEXP])
            || !DataProcessor::validateType([$postData['phonenumber'] => FILTER_SANITIZE_NUMBER_INT])
            || !DataProcessor::validateType([$postData['password'] => FILTER_VALIDATE_REGEXP])
            || !DataProcessor::validateType([$postData['password-confirm'] => FILTER_VALIDATE_REGEXP])
        ) {
            return parent::handleError("REGISTER_ERROR", "An error occured, try again later.", "register");
        }

        if ($postData['password'] !== $postData['password-confirm']) {
	        return parent::handleError("REGISTER_ERROR", "Passwords do not match.", "register");
        }

        if (DataProcessor::registeredValue('user', ['email' => $postData['email']])) {
            return parent::handleError("REGISTER_ERROR", "EMail already registered.", "register");
        }

        if (!User::create($postData)) {
            return parent::handleError("REGISTER_ERROR", "Failed to insert record. Try again later!", "register");
        }

        parent::handleError("REGISTER_ERROR", "Account registered.", "login");
        return true;
    }
}

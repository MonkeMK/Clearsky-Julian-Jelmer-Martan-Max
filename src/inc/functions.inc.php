<?php

function recaptcha($POST) {
    $secretKey = '6LdY5YIpAAAAALfCIfLdbxtNxSeZFpqzVlhSrbQs';
    $captcha = $POST['g-recaptcha-response'];
    
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    return $responseKeys["success"];
}

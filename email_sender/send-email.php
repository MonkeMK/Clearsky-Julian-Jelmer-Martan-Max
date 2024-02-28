<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail = $_POST["email"];

    // Your email configuration
    $to = $userEmail;
    $subject = 'Test Email';
    $message = 'This is a test email sent from your web application.';
    $headers = 'From: your@gmail.com'; // Replace with your email

    // Send email using the mail() function
    $success = mail($to, $subject, $message, $headers);

    if ($success) {
        echo 'Email sent successfully.';
    } else {
        echo 'Error sending email.';
    }
}
?>

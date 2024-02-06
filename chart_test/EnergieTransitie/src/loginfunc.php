<?php

include("get_data.php");
session_start();
// Retrieve username and password from a form
$username = $_POST['admin'];
$password = $_POST['password'];

// Sanitize input
$username = filter_var($username, FILTER_SANITIZE_STRING);
$password = filter_var($password, FILTER_SANITIZE_STRING);


// Prepare the SQL statement
$sql = "SELECT * FROM admins WHERE username = :username AND password = :password";

// Bind the parameters
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);

// Execute the query
$stmt->execute();

// Check if a row is returned
if ($stmt->rowCount() > 0) {
    // Username and password exist in the database
    // Set session variables
    $_SESSION['username'] = $username;
    $_SESSION['loggedin'] = true;
    
    // Redirect to a page after successful login
    header("Location: admin.php");
    exit;
} else {
    // Username and password do not exist in the database
    echo "Invalid username or password.";
    header("location: login.php ");
}
?>
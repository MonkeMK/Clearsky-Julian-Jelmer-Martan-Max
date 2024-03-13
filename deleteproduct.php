<?php
// Check if a delete request was sent via GET method
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Include your database connection file here
    include_once("database.php"); 
    $conn = connection(); // Assuming this function returns a PDO connection object

    // Check connection
    if (!$conn) {
        die("Connection failed");
    }

    // Prepare the SQL statement to delete a record
    $sql = "DELETE FROM products WHERE id=:id";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        // If deletion is successful, redirect to a success page
        header("Location: productoverview.php");
        exit(); // Make sure to stop executing further code after redirection
    } else {
        // If there's an error, redirect to an error page with error message
        $errorInfo = $stmt->errorInfo();
        header("Location: error.php?msg=" . urlencode("Error deleting record: " . $errorInfo[2]));
        exit();
    }
}
?>
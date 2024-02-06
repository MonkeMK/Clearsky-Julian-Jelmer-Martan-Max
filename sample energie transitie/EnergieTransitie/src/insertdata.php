<?php
include("get_data.php");
// Get the form data
$sensor1 = $_POST['sensor1'];
$sensor2 = $_POST['sensor2'];
$sensor3 = $_POST['sensor3'];

try {

    // Insert the data into the database
    $stmt = $conn->prepare("INSERT INTO sensordata (Sensor1, Sensor2, Sensor3) VALUES ($sensor1, $sensor2, $sensor3)");
    $stmt->execute();

    // Redirect to a success page
    header("Location: admin.php");
} catch(PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
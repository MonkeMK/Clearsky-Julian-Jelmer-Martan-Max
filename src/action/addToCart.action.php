<?php
session_start(); // Start the session if not already started

include 'classes/cart.php';

$cart = new cart();

// Check if 'id' is set in the POST data
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $cart->addItem($id);

    // Check if the referring page is set in the session
    if(isset($_SESSION['referer'])) {
        // Redirect to the referring page
        header('Location: ' . $_SESSION['referer']);
    } else {
        // Redirect to the index page if the referring page is not set
        header('Location: products.php');
    }
} else {
    $_SESSION["pizza_error_size_message"] = "Please select a size";
    // Redirect to the referring page with an added error message
    header('Location: ' . $_SESSION['referer']);
}
?>

// If no size is selected go back to pizza and say blah


<?php

include 'classes/cart.php';

$cart = new cart();
if (isset($_GET['id']) && isset($_GET['size'])) {
    $id = $_GET['id'];
    $size = $_GET['size'];
    $cart->addItem($id, $size);
    header('Location: index.php');
} else {
    $_SESSION["pizza_error_size_message"] = "Please select a size";
    header('Location: product.php?id=' . $_GET['id'] . '.php');
}

// If no size is selected go back to pizza and say blah


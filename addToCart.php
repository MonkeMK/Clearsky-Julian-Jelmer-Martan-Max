<?php

include 'classes/cart.php';

$cart = new cart();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $cart->addItem($id);
    header('Location: index.php');
} else {
    $_SESSION["pizza_error_size_message"] = "Please select a size";
    header('Location: afspraak.php?id=' . $_GET['id'] . '.php');
}

// If no size is selected go back to pizza and say blah


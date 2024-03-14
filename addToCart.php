<?php
session_start();

include 'classes/cart.php';

$cart = new cart();

if (isset ($_POST['id'])) {
    $id = $_POST['id'];
    $cart->addItem($id);

    if (isset ($_SESSION['referer'])) {
        header('Location: index.php');
    } else {
        header('Location: product.php');
    }
} else {
    $_SESSION["pizza_error_size_message"] = "Please select a size";
    header('Location: ' . $_SESSION['referer']);
}
?>
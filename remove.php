<?php

include_once('classes/cart.php');

$cart = new cart();
if (isset($_GET['key'])) {
    $key = $_GET['key'];
    $cart->deleteItem($key);
}

header('Location: index.php');


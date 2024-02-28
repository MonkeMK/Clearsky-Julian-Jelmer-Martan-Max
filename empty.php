<?php

include 'classes/cart.php';

$cart = new cart();
$cart->flush();

header('Location: index.php');

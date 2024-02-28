<?php

include_once('database.php');
include_once('classes/cart.php');

$cart = new cart(); // Create a new instance of the cart class

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel=stylesheet href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-+0V4cXq+QRoi6iKzK2KRP3zZlNQrj5819m1GfOJwXwXcA+toUOD2KhTjhp5jcqv5" crossorigin="anonymous"></script>
    <title>Clearsky</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
</head>

<body>
    
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light" data-bs-theme="dark">
        <div class="container-fluid">
            <a href="index.php"><img src="assets/Logo.png" width="100" height="100"></a>
            <ul class="navbar-nav d-flex justify-content-around align-items- w-100">
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Producten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="afspraak.php">Maak hier een afspraak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.html">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="overons.php">Over ons</a>
                </li>
                <li class="nav-item dropdown">
                    <?php 
                    if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === 1) { ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="user.php">My Account</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    <?php } else { ?>
                        <a class="nav-link" href="login.php">Login</a>
                    <?php } ?>
                </li>
            </ul>
            <button class="btn btn-primary btn-sm ms-auto" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Cart</button>
        </div>
    </nav>
</header>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php
        // Retrieve cart items and display them
        foreach ($cart->getCart() as $key => $item) {
            // Retrieve product details from the database based on the ID
            $conn = connection();
            $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $product = $stmt->fetch();

            if ($product) {
                $name = $product['name'];
                $description = $product['description'];
                $price = $product['price'];
                $image = $product['image'];

                // Output the product details
                ?>
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="assets/img/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $name; ?></h5>
                                <p>Description: <?php echo $description; ?></p>
                                <p>Price: <?php echo number_format($price, 2); ?></p>
                                <p>Quantity: <?php echo $quantity; ?></p>
                                <a href="remove.php?key=<?php echo $key; ?>" class="btn btn-danger">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
        <a href="empty.php" class="btn btn-danger">Empty Cart</a>
    </div>
</div>

</body>
</html>

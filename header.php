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

    <?php
        include_once('database.php');
        include_once('classes/cart.php');
        $cart = new cart();
    ?>
    
</head>

<body>
    
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light" data-bs-theme="dark">
        <div class="container-fluid">
            <a href="index.php"><img src="assets/Logo.png"width="100" height="100"></a>
            <ul class="navbar-nav d-flex justify-content-around align-items- w-100">
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Producten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="afspraak.html">Maak hier een afspraak</a>
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
                foreach ($cart->getCart() as $key => $item) {
                    $id = $item['id'];
                    $size = $item['size'];
                    $quantity = $item['quantity'];

                    // Retrieve pizza details from the database based on the ID
                    $conn = connection();
                    $stmt = $conn->prepare("SELECT * FROM product WHERE id = :id");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    $pizza = $stmt->fetch();

                    $name = $pizza['name'];
                    $price = $pizza['price'];
                    $image = $pizza['image'];
                    $type = $pizza['type'];

                    // Calculate the price based on the pizza size
                    if ($size === 'S') {
                        $price *= 0.75;
                    } elseif ($size === 'L') {
                        $price *= 1.25;
                    }

                    ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="assets/img/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $name; ?>
                                    </h5>
                                    Price:
                                    <?php echo number_format($price, 2); ?><br>
                                    Size:
                                    <?php echo $size; ?><br>
                                    Quantity:
                                    <?php echo $quantity; ?>
                                    <p class="card-text">Type:
                                        <?php echo $type; ?>
                                    </p>
                                    <a href="remove.php?key=<?php echo $key; ?>" class="btn btn-danger">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <a href="checkout.php" class="btn btn-primary">Checkout</a>
                <a href="empty.php" class="btn btn-danger">Empty Cart</a>
            </div>
        </div>
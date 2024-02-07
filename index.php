<!DOCTYPE html>
<html lang="en">

<?php
    include_once("../Clearsky-Julian-Jelmer-Martan-Max/allphp/database.php");
    include_once('../Clearsky-Julian-Jelmer-Martan-Max/classes/cart.php');
    $cart = new cart();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearsky</title>
    <link rel="stylesheet" href="../Clearsky-Julian-Jelmer-Martan-Max/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">
                    <img src="../Clearsky-Julian-Jelmer-Martan-Max/assets/Logo.png" alt="logo" width="100" height="100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../Productpage/product.html">Producten</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../afspraak system/afspraak.html">Maak hier een afspraak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/services.html">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../contactpage/contact.html">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <?php 
                                if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === 1) { ?>
                                <a class="nav-link dropdown-toggle link-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Account
                                </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="user.php">My Account</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                            <?php } else { ?>
                                <a class="nav-link link-light" href="login.php">Login</a>
                            <?php } ?>
                        </li>
                    </ul>
                    <button class="btn btn-primary btn-sm ms-auto" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Cart</button>
                </div>
                </nav>

                </div>
            </div>
        </nav>
     <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
        
    </header>
</body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="tekst1">Welkom bij Clearsky</h1>
                <p class="tekst2">Clearsky is een bedrijf dat zich specialiseert in het maken van zonnepanelen en het instaleren van zonnepanelen. Wij
                bieden een breed scala aan diensten aan, Het instaleren van kleine tot aan grote zonnepanelen. Wij bieden ook de mogelijkheid om een afspraak te maken voor een
                consultatie. Wij zullen dan samen met u kijken naar de mogelijkheden en de beste oplossing voor uw
                wensen.</p>
            </div>
        </div> 
        
        <div class="d-flex flex-wrap justify-content-around">
        <?php
        $conn = connection();

        $stmt = $conn->prepare("SELECT * FROM products LIMIT 6");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        foreach ($result as $r) {
            ?>
            <div class="card mx-5 mb-5" style="width: 20rem;">
                <div class="card-img-top d-flex align-items-center">
                    <div>
                        <img class="card-img-top p-2" src="assets/img/<?php echo $r['image']; ?>" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $r['name']; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $r['description']; ?>
                        </p>
                        <p class="card-text"><small class="text-muted">
                                <?php echo $r['price']; ?>
                            </small></p>
                        <a href="product.php?id=<?php echo $r['id']; ?>" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <?php

        }
        ?>
</body>
</html>














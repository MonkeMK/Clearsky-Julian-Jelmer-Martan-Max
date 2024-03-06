<html>
<head>
	<title>Clearsky - <?= ucfirst($page) ?></title>

	<!-- style sheets -->
	<link rel="stylesheet/css" href="<?= $_PATHS['web'] ?>/css/<?= $page ?>.css">
	<link rel="stylesheet" href="<?= $_PATHS['web'] ?>/libs/fontawesome/all.min.css">
	<link rel="stylesheet/less" href="<?= $_PATHS['web'] ?>/less/styles.less">

	<script src="<?= $_PATHS['web'] ?>/libs/less/less.js"></script>

	<!-- bootstrap jumble -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-+0V4cXq+QRoi6iKzK2KRP3zZlNQrj5819m1GfOJwXwXcA+toUOD2KhTjhp5jcqv5"
        crossorigin="anonymous"></script>

	<!-- icon -->
	<link rel="icon" type="image/x-icon" href="<?= $_PATHS['web'] ?>/favicon.ico">
</head>
<body>
<header>
	<nav class="navbar navbar-expand-lg bg-body-tertiary bg-light" data-bs-theme="dark">
		<div class="container-fluid">
		<a href="<?= $_PATHS['web'] ?>/home"><img src="<?= $_PATHS['web'] ?>/media/Logo.png" width="100" height="100"></a>
			<ul class="navbar-nav d-flex justify-content-around align-items- w-100">
				<li class="nav-item">
					<a class="nav-link" href="<?= $_PATHS['web'] ?>/product">Producten</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $_PATHS['web'] ?>/afspraak">Maak hier een afspraak</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $_PATHS['web'] ?>/dashboard">Dashboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= $_PATHS['web'] ?>/overons">Over ons</a>
				</li>
				<li class="nav-item dropdown">
				<?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === 1): ?>
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
						data-bs-toggle="dropdown" aria-expanded="false">
						Account
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="<?= $_PATHS['web'] ?>/user">My Account</a></li>
						<li><a class="dropdown-item" href="<?= $_PATHS['web'] ?>/logout">Logout</a></li>
					</ul>
				<?php else: ?>
					<a class="nav-link" href="<?= $_PATHS['web'] ?>/login">Login</a>
				<?php endif; ?>
				</li>
			</ul>
		</div>
	</nav>
</header>
<main>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Winkelwagen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
		<?php
		$cart = new Cart();
		$cartItems = $cart->getCart();
		if (empty($cartItems)) {
			echo "<p>Geen producten in je winkelwagen</p>";
		} else {
			$db = new Database();
			$conn = $db->pdo;
			foreach ($cartItems as $key => $item) {
				$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
				$stmt->bindParam(':id', $item["id"]);
				$stmt->execute();
				$product = $stmt->fetch();
				if ($product) {
					$name = $product['name'];
					$description = $product['description'];
					$price = $product['price'];
					$image = $product['image'];
		?>
			<div class="card mb-3">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="assets/<?= $image; ?>" alt="<?= $name; ?>" class="img-fluid">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title">
								<?php echo $name; ?>
							</h5>
							<p>Beschrijving:
								<?php echo $description; ?>
							</p>
							<?php echo "Prijs: €" . number_format($product["price"] * $item["quantity"], 2); ?><br>
							<p>Aantal:
								<?php echo $item['quantity']; ?>
							</p>
							<a href="<?= $_PATHS['web'] ?>/remove?key=<?php echo $key; ?>" class="btn btn-danger">Remove</a>
						</div>
					</div>
				</div>
			</div>
		<?php
			}
		}
		?>
			<a href="<?= $_PATHS['web'] ?>/checkout" class="btn btn-primary">Checkout</a>
			<a href="<?= $_PAGES['web'] ?>/empty" class="btn btn-danger">Empty Cart</a>
		<?php } ?>
	</div>

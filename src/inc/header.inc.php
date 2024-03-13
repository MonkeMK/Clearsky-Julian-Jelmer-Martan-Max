<html>
<head>
	<title>Clearsky - <?= ucfirst($page) ?></title>

	<!-- bootstrap jumble -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-+0V4cXq+QRoi6iKzK2KRP3zZlNQrj5819m1GfOJwXwXcA+toUOD2KhTjhp5jcqv5"
        crossorigin="anonymous"></script>

	<!-- stylesheets -->
	<link rel="stylesheet/less" href="<?= _PATHS['web'] ?>/styling/styles.less">

	<!-- bootstrap icons -->	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<!-- page specific stylesheet -->
	<?php if (file_exists(_PATHS['webroot']."/styling/".$page.".less")): ?>
	<link rel="stylesheet/less" href="<?= _PATHS['web'] ?>/styling/<?= $page ?>.less">
	<?php endif; if (file_exists(_PATHS['webroot']."/styling/".$page.".css")): ?>
	<link rel="stylesheet/css" href="<?= _PATHS['web'] ?>/styling/<?= $page ?>.css">
	<?php endif; ?>

	<!-- font(s) -->
	<style>@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');</style>

	<!-- less library -->
	<script src="<?= _PATHS['web'] ?>/libs/less/less.js"></script>

	<!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<!-- icon -->
	<link rel="icon" type="image/x-icon" href="<?= _PATHS['web'] ?>/favicon.ico">
</head>
<?php $cart = new Cart() ?>
<body>
<?php if (!in_array($page, _CONFIG['Blacklists']['header'])): ?>
<header>
	<nav class="navbar navbar-expand-lg bg-body-tertiary bg-light" data-bs-theme="dark">
		<div class="container-fluid">
			<a href="home"><img src="<?= _PATHS['web'] ?>/media/Logo.png" width="100" height="100"></a>
			<ul class="navbar-nav d-flex justify-content-around align-items- w-100">
				<li class="nav-item">
					<a class="nav-link" href="products">Producten</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="afspraak">Maak hier een afspraak</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="dashboard">Dashboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="overons">Over ons</a>
				</li>
				<li class="nav-item dropdown">
				<?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true): ?>
					<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Account
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="user">My Account</a></li>
						<li><a class="dropdown-item" href="logout">Logout</a></li>
					</ul>
				<?php else: ?>
					<a class="nav-link" href="login">Login</a>
				<?php endif; ?>
				</li>
			</ul>
		</div>
		<script>
			document.querySelectorAll('body > header > nav > div > ul > li.nav-item > .nav-link').forEach((el) => {
				const el_page = el.href.split('/').pop();
				if (el_page == "<?= $page ?>" && el_page != "") {
					el.classList.add('on');
				}
			});
		</script>	
	</nav>
</header>
<?php endif; ?>
<main>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Winkelwagen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php
            $cartItems = $cart->getCart();
            if (empty($cartItems)) {
                echo "<p>Geen producten in je winkelwagen</p>";
            } else {
                foreach ($cartItems as $key => $item) {
                    $conn = connection();
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
                                    <img src="assets/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="img-fluid">
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
                                        <a href="remove.php?key=<?php echo $key; ?>" class="btn btn-danger">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <a href="checkout" class="btn btn-primary">Checkout</a>
                <a href="empty" class="btn btn-danger">Empty Cart</a>
            <?php } ?>
        </div>
    </div>

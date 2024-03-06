<div class="unstyled-container products">
	<h1>Producten</h1>

	<?php
	$db = new Database();
	$products = $db->query("SELECT * FROM products LIMIT 32;");
	?>

	<div class='card-container'>
	<?php foreach ($products as $r): ?>
	<?php $productId = $r['id']; ?>
        <!-- <div class="card mx-5 mb-5" onclick="enable_overlay(this)"> -->
        <div class="card mx-5 mb-5">
            <div class="card-img-top-container">
				<img class="card-img-top p-2" src="<?= $_PATHS['web'] ?>/media/products/<?= $r['image']; ?>" alt="Card image cap">
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <?= $r['name']; ?>
                </h5>
                <p class="card-text">
					<?= $r['description']; ?>
                </p>
                <p class="card-text"><small class="text-muted">
                € <?= $r['price']; ?>
                </small></p>
			<?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === 1): ?>
				<form action="<?= $_PATHS['action'] ?>/addToCart.action.php" method="post">
                    <input type="hidden" name="id" value="<?= $productId; ?>"> 
                    <div class="d-flex justify-content-center">
                        <input type="submit" class="knop" value="Add to cart">
                    </div>
                </form>
			<?php endif; ?>
            </div>
            <div class="overlay">
                <div class="overlay-content">
                    <!-- Content will be dynamically populated here -->
                </div>
            </div>
        </div>
	<?php endforeach; ?>
	</div>
</div>

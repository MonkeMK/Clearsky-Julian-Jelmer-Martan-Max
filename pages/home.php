<div class="d-flex flex-wrap justify-content-around" style="margin-top: 250px;">
	<?php
	$db = new Database();
    $conn = $db->pdo;

    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	?>

	<?php foreach ($result as $r): ?>
	<?php $productId = $r['id']; ?>
        <div class="card mx-5 mb-5 overlay-container" style="width: 20rem;">
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
				<form action="<?= $_PATHS['action'] ?>/addToCart.php" method="post">
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


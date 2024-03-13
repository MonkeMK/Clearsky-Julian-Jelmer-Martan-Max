<div class="unstyled-container home">
	<div>
		<h1>Welkom bij Clearsky</h1>
		<p>Wij van Clearsky leveren u de beste producten op de markt. We zorgen voor de beste kwaliteit voor de laagste prijs. Neem een kijkje in ons assortiment en laat u verrassen door de kwaliteit van onze producten. ❤️</p> 
	</div>
</div>

<div class="unstyled-container products">
	<?php
	$dbh = new Database();
	$products = $dbh->query("SELECT * FROM products LIMIT 4;");
	?>

	<div class='card-container'>
	<?php foreach ($products as $r): ?>
	<?php $productId = $r['id']; ?>
        <!-- <div class="card mx-5 mb-5" onclick="enable_overlay(this)"> -->
        <div class="card mx-5 mb-5">
            <div class="card-img-top-container">
				<img class="card-img-top p-2" src="<?= _PATHS['web'] ?>/media/products/<?= $r['image']; ?>" alt="Card image cap">
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
				<form action="<?= _PATHS['action'] ?>/addToCart.action.php" method="post">
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

<script>
	function enable_overlay(element) {
		if (event.target.classList.contains('btn-primary')) {
			return; // Do nothing and let the default action proceed
		}

		const overlay = element.querySelector('.overlay');
		const name = element.querySelector('.card-title').textContent;
		const description = element.querySelector('.card-text').textContent;
		const price = element.querySelector('.text-muted').textContent;
		const imageSrc = element.querySelector('.card-img-top').src;

		const overlayContent = overlay.querySelector('.overlay-content');
		overlayContent.innerHTML = `
			<div>
				<img src="${imageSrc}" alt="Product Image">
				<h5>${name}</h5>
				<p>${description}</p>
				<p>${price}</p>
				<?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === 1) { ?>
				<a href="addToCart.php?id=<?php echo $productId; ?>" class="btn btn-primary">Toevoegen</a>
				<?php } ?>
				<button class="btn btn-secondary" onclick="location.href='home'">Back</button>
			</div>
		`;

		if (overlay.style.display == 'block') {
			overlay.style.display = 'none';
		} else {
			overlay.style.display = 'block';
		}
	}
</script>

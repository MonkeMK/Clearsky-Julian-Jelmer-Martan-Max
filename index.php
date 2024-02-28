<!DOCTYPE html>
<html lang="en">
<?php
    
    include_once("header.php");
    include_once('database.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearsky</title>
    <link rel="stylesheet" href="../Clearsky-Julian-Jelmer-Martan-Max/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="../Clearsky-Julian-Jelmer-Martan-Max/css/style.css">
</head>
<style>
        body {
            background-image: url("../Clearsky-Julian-Jelmer-Martan-Max/assets/background.png");
            background-color: white;
            heigcht: 900px;
            background-position: 0 0;
            background-repeat: repeat;
            position: relative;
            animation: slide 30s linear infinite;
        }
</style>
<body>
<div class="container">
    <h1>Welkom bij Clearsky</h1>
    <p>Wij van Clearsky leveren u de beste producten op de markt. We zorgen voor de beste kwaliteit voor de laagste prijs. Neem een kijkje in ons assortiment en laat u verrassen door de kwaliteit van onze producten. ❤️</p> 
</div>

<div class="d-flex flex-wrap justify-content-around" style="margin-top: 250px;">
    <?php
    $conn = connection();

    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $r) {
    ?>
        <div class="card mx-5 mb-5 overlay-container" style="width: 20rem;">
            <div class="card-img-top-container">
                <img class="card-img-top p-2" src="assets/<?php echo $r['image']; ?>" alt="Card image cap">
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $r['name']; ?>
                </h5>
                <p class="card-text">
                    <?php echo $r['description']; ?>
                </p>
                <p class="card-text"><small class="text-muted">
                € <?php echo $r['price']; ?>
                </small></p>
                <a href="product.php?id=<?php echo $r['id']; ?>" class="btn btn-primary">Add to cart</a>
            </div>
            <div class="overlay">
                <div class="overlay-content">
                    <!-- Content will be dynamically populated here -->
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<footer class="text-center text-lg-start bg-light text-muted" style="position:absolute; left:0%; width: 100%;">
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        <b>&copy Copyright by Clearsky</b>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
<script src="script.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const overlayContainers = document.querySelectorAll('.overlay-container');

        overlayContainers.forEach(container => {
            container.addEventListener('click', function () {
                const overlay = this.querySelector('.overlay');
                const name = this.querySelector('.card-title').textContent;
                const description = this.querySelector('.card-text').textContent;
                const price = this.querySelector('.text-muted').textContent;
                const imageSrc = this.querySelector('.card-img-top').src;

                const overlayContent = overlay.querySelector('.overlay-content');
                overlayContent.innerHTML = `
                    <div>
                        <img src="${imageSrc}" alt="Product Image">
                        <h5>${name}</h5>
                        <p>${description}</p>
                        <p>${price}</p>
                        <a href="product.php?id=<?php echo $r['id']; ?>" class="btn btn-primary">Add to cart</a>
                        <a href="product.php" class="btn btn-secondary">Back</a>
                    </div>
                `;

                overlay.style.display = 'block';
            });
        });
    });
</script>
</body>
</html>

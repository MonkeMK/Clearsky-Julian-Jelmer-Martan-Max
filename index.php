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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../Clearsky-Julian-Jelmer-Martan-Max/css/style.css">
    <style>
        body {
            background-image: url("../Clearsky-Julian-Jelmer-Martan-Max/assets/background.png");
            background-color: white;
            height: 900px;`
            background-position: 0 0;
            background-repeat: repeat;
            position: relative;
            animation: slide 30s linear infinite;
        }

        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none; /* Hide initially */
        }

        .overlay-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f5f5f5;
            padding: 10px; /* Adjust the padding to make the overlay smaller */
            border-radius: 5px;
            text-align: center; /* Center align content */
            width: 50%; /* Set the width of the overlay */
        }

        .overlay-content img {
            max-width: 40%; /* Limit image width */
            max-height: 40%; /* Limit image height */
            height: auto;
            width: auto;
            margin-bottom: 20px; /* Add some space below the image */
            background-color: transparent;
            border: none; /* Remove border */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welkom bij Clearsky</h1>
    <p>Wij van Clearsky leveren u de beste producten op de markt. We zorgen voor de beste kwaliteit voor de laagste prijs. Neem een kijkje in ons assortiment en laat u verrassen door de kwaliteit van onze producten. ❤️</p> 
</div>

<div class="d-flex flex-wrap justify-content-around" style="margin-top: 250px;">
    <?php
    $conn = connection();

    $stmt = $conn->prepare("SELECT * FROM products LIMIT 8 "); // Fetch only 6 products
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $r) {
        $productId = $r['id']; // Store the product ID in a variable
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
                <?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === 1) { ?>
                <form action="addToCart.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $productId; ?>"> 
                    <div class="d-flex justify-content-center">
                        <input type="submit" class="knop" value="Toevoegen">
                    </div>
                </form>
                <?php } ?>
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
            container.addEventListener('click', function (event) {
                // Check if the clicked element is the "Add to cart" button
                if (event.target.classList.contains('btn-primary')) {
                    return; // Do nothing and let the default action proceed
                }

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
                        <?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === 1) { ?>
                        <a href="addToCart.php?id=<?php echo $productId; ?>" class="btn btn-primary">Toevoegen</a>
                        <?php } ?>
                        <a href="index.php" class="btn btn-secondary">Back</a>
                    </div>
                `;

                overlay.style.display = 'block';
            });
        });
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearsky</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
include_once ("header.php");
include_once ('database.php');
?>

<body>

    <div class="container1">
        <h1>Welkom bij Clearsky</h1>
        <p>Wij van Clearsky leveren u de beste producten op de markt. We zorgen voor de beste kwaliteit voor de laagste
            prijs. Neem een kijkje in ons assortiment en laat u verrassen door de kwaliteit van onze producten. ❤️</p>
    </div>

    <div class="d-flex flex-wrap justify-content-around" style=" margin-top: 250px;">
        <?php
        $conn = connection();

        $stmt = $conn->prepare("SELECT * FROM products LIMIT 8 ");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $r) {
            $productId = $r['id'];
            ?>
            <div class="card mx-5 mb-5 overlay-container" style="max-width: 15%; position: relative;">
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
                            €
                            <?php echo $r['price']; ?>
                        </small></p>
                </div>
                <form action="addToCart.php" method="POST"
                    style="position: absolute; padding:5px; bottom: 0%; left: 80%; transform: translateX(-50%);">
                    <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                    <button type="submit" class="knop btn-primary" style="width: 100%;">Toevoegen</button>
                </form>
                <div class="overlay">
                    <div class="overlay-content">
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
                        <?php if (isset ($_SESSION["logged_in"]) && $_SESSION["logged_in"] === 1) { ?>
                                <a href="addToCart.php?id=<?php echo $productId; ?>" class="btn btn-primary">Toevoegen</a>
                        <?php } ?>
                        <a href="index.php" class="btn btn-secondary">Terug</a>
                    </div>
                `;

                    overlay.style.display = 'block';
                });

                // Add event listener for "Toevoegen" button
                const toevoegenButtons = container.querySelectorAll('.btn-primary');
                toevoegenButtons.forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.stopPropagation(); // Prevent event from bubbling up to the container
                        const productId = this.getAttribute('data-product-id');
                        window.location.href = `addToCart.php?id=${productId}`; // Redirect to addToCart.php with product ID
                    });
                });
            });
        });
    </script>

</body>

</html>
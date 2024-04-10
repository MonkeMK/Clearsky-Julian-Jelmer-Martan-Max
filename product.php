<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearsky</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    include_once ("header.php");
    include_once ('database.php');
    ?>
    <div class="d-flexproduct flex-wrap justify-content-around" style="margin-top: 100px;">
        <?php
        $conn = connection();

        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $r) {
            ?>
            <div class="card mx-5 mb-5 overlay-container" style="position:relative; max-width: 15%;">
                <div class="card-img-top-container">
                    <img class="card-img-top p-2" src="assets/Images/<?php echo $r['image']; ?>" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $r['name']; ?>
                    </h5>
                    <p class="card-text">
                        <?php 
                        // Get the description from the PHP variable
                        $description = $r['description'];

                        // Count the words in the description
                        $wordCount = str_word_count($description);

                        // Check if the word count exceeds 50
                        if ($wordCount > 50) {
                            // If more than 50 words, limit the description to 50 words and append "..."
                            $limitedDescription = implode(' ', array_slice(str_word_count($description, 1), 0, 50)) . '...';
                            echo $limitedDescription;
                        } else {
                            // If less than or equal to 50 words, display the original description
                            echo $description;
                        }
                        ?>
                    </p>
                    <p class="card-text"><small class="text-muted">
                            €
                            <?php echo $r['price']; ?>
                        </small></p>
                    <?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === 1) { ?>
                        <form action="addToCart.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                            <button type="submit" class="knopproduct btn-primary">Toevoegen</button>
                        </form>
                    <?php } ?>
                </div>
                <div class="overlayproduct">
                    <div class="overlay-contentproduct">
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
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addToCartButtons = document.querySelectorAll('.btn-primary');

            addToCartButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.stopPropagation(); // Prevent the click event from propagating to the container
                });
            });

            const cardContainers = document.querySelectorAll('.card');

            cardContainers.forEach(container => {
                container.addEventListener('click', function () {
                    const overlay = this.querySelector('.overlayproduct');
                    const name = this.querySelector('.card-title').textContent;
                    const description = this.querySelector('.card-text').textContent;
                    const price = this.querySelector('.text-muted').textContent;
                    const imageSrc = this.querySelector('.card-img-top').src;

                    const overlayContent = overlay.querySelector('.overlay-contentproduct');
                    overlayContent.innerHTML = `
                <div>
                    <img src="${imageSrc}" alt="Product Image">
                    <h5>${name}</h5>
                    <p>${description}</p>
                    <p>${price}</p>
                    <a href="product.php" class="btn btn-secondary">Terug</a>
                </div>
            `;

                    overlay.style.display = 'block';
                });
            });
        });
    </script>
</body>

</html>

<?php
include_once ('classes/cart.php');
include_once ('header.php');
include_once ("database.php");
?>
<!DOCTYPE html>
<html lang="en">

<body>
  <body>
    <div class="d-flex flex-wrap">
        <div class="float-end w-100">
            <!-- Titel van de winkelwagen -->
            <h3 style="position:absolute; top:15%; left:5%;">Winkelwagen</h3>
            <div class="card-grid">
                <?php
                $count = 0;
                $totalPrice = 0;

                // Controleer of de winkelwagen niet leeg is
                if (!empty ($cart->getCart())) {
                    foreach ($cart->getCart() as $key => $item) {
                        $count++;

                        // Verbinding maken met de database en productinformatie ophalen
                        $conn = connection();
                        $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
                        $stmt->bindParam(':id', $item["id"]);
                        $stmt->execute();
                        $product = $stmt->fetch();

                        // Berekenen van de totale prijs van het product en het bijwerken van de totale winkelwagenprijs
                        $price = $product['price'] * $item['quantity'];
                        $totalPrice += $price;
                        ?>

                        <!-- Kaart voor elk product in de winkelwagen -->
                        <div class="card">
                            <img src="assets/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"
                                class="img-fluid m-4" style="max-width: 200px; max-height: 200px;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $product["name"]; ?>
                                </h5>
                                <?php echo "Beschrijving: " . $product["description"]; ?><br>
                                <?php echo "Prijs: €" . number_format($product["price"] * $item["quantity"], 2); ?><br>
                                <?php echo "Aantal: " . $item['quantity']; ?><br>
                                <br>
                                <a href="remove.php?key=<?php echo $key; ?>" class="btn btn-danger">Verwijderen</a>
                            </div>
                        </div>
                    <?php }
                } else {
                    // Bericht weergeven als de winkelwagen leeg is
                    echo "<p>Je hebt nog geen pizza's toegevoegd.</p>";
                }

                ?>
            </div>
            <!-- Totaalprijs sectie buiten de kaartgrid -->
            <h4 style="position:absolute; top: 72%; left:5%;">Totaalprijs:
                <?php echo number_format($totalPrice, 2); ?>
            </h4>
        </div>
    </div>

    <hr style="position:absolute; top:75%; width:95%; border-top: 2px solid black; left:2.5%;">
    <br>
    <be>
        <div class="container">
            <div class="offcanvas-body">
                <div class="center-content">
                    <div class="w-50">
                        <!-- Titel voor factuurgegevens -->
                        <h3 class="titel">Factuurgegevens</h3>
                        <div class="form">
                            <!-- Formulier voor het invoeren van factuurgegevens -->
                            <form method="POST" style="display: flex; flex-direction: column; align-items: center;">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-32">
                                    <label for="land" class="form-label">Land:</label>
                                    <!-- Selectie van land -->
                                    <select style="max-width:90%;" class="form-select" id="country" name="country"
                                        required>
                                        <option value="">Selecteer uw land</option>
                                        <!-- Lijst van landen -->
                                        <!-- (De lijst is vrij lang, daarom zijn alle opties niet vertaald) -->
                                    </select>
                                </div>
                                <!-- Voornaam, achternaam, postcode, huisnummer, straatnaam, plaats, telefoonnummer invoervelden -->
                                <!-- (De labels zijn in het Nederlands) -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Verzendopties sectie -->
        <hr style="position:absolute; top:175%; width:95%; border-top: 2px solid black; left:2.5%;">
        <h3 style="position:absolute; top:180%; left:5%;">Verzendopties</h3>
        <!-- Formulier voor het selecteren van verzendopties -->
        <form style="position:absolute; top:185%; left:5%;" required>
            <div class="radio-container">
                <input type="radio" id="thuis" name="verzendoptie" value="thuis">
                <label for="thuis">Thuis laten bezorgen</label>
            </div>
            <!-- (De labels zijn in het Nederlands) -->
        </form>
        <!-- Knop voor betaling -->
        <hr style="position:absolute; top:197%; width:95%; border-top: 2px solid black; left:2.5%;">
        <form action="" method="POST">
            <input type="hidden" name="checkout_submit" value="1">
            <button type="submit" name="checkout" value="1" class="checkoutknop btn-primary">Betalen</button>
        </form>

        <?php
        // Afhandeling van het afrekenen
        if (isset ($_POST['checkout'])) {
            $cart->emptyCart(); // Winkelwagen leegmaken na succesvol afrekenen
            echo "
            <script>
                alert('Je bestelling is succesvol geplaatst!')
                setTimeout(function () {
                    window.location.href = 'index.php';
                }, 10); // De vertraging aanpassen indien nodig
            </script>
            ";
        }
        ?>
</body>

je moeder


</html>
<?php
include_once('classes/cart.php');
include_once('header.php');
include_once("database.php");
?>

<style>
    .mb-32 {
        margin-left: 7%;
        margin-bottom: 10%;
    }

    .container {
        position: absolute;
        top: 70%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form {
        position: absolute;
        left: 5%;
        top: 20%;
    }

    .card {
        max-width: 200px;
    }

    .titel {
        text-align: center;
        position: absolute;
        left: 5%;
        top: 15%;
    }

    .center-content {
        left: 50%;
        width: 100%;
        height: 100%;
        top: 20%;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        grid-gap: 10px;
        margin-top: 4%;
        margin-left: 5%;
    }

    .radio-container {
        display: block;
        margin-bottom: 10px;
    }

    .checkoutknop {
        position: relative;
        margin-top: 75%;
        /* Adjust as needed */
        margin-bottom: 5%;
        left: 45%;
        color: white;
        background-color: #103E7E;
        border: solid #103E7E;
        border-radius: 10px;
        height: 5%;
        transition: 0.2s;
        width: 10%;
        font-size: 20px;
    }

    .checkoutknop:hover {
        color: white;
        background-color: #3050A8;
        border: solid #3050A8;
    }
</style>

<body>
    <div class="d-flex flex-wrap">
        <div class="float-end w-100">
            <h3 style="position:absolute; top:15%; left:5%;">Winkelwagen</h3>
            <div class="card-grid">
                <?php
                $count = 0;
                $totalPrice = 0;

                if (!empty($cart->getCart())) {
                    foreach ($cart->getCart() as $key => $item) {
                        $count++;

                        $conn = connection();
                        $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
                        $stmt->bindParam(':id', $item["id"]);
                        $stmt->execute();
                        $product = $stmt->fetch();

                        $price = $product['price'] * $item['quantity'];
                        $totalPrice += $price;
                        ?>

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
                    echo "<p>You have not added any pizzas.</p>";
                }

                ?>
            </div>
            <!-- Total price section moved outside of the card grid -->
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
                        <h3 class="titel">Factuurgegevens</h3>
                        <div class="form">
                            <form method="POST" style="display: flex; flex-direction: column; align-items: center;">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-32">
                                    <label for="land" class="form-label">Land:</label>
                                    <select style="max-width:90%;" class="form-select" id="country" name="country"
                                        required>
                                        <option value="">Select your country</option>
                                        <option value="AX">Aland Islands</option>
                                        <option value="AL">Albania</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AT">Austria</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="EE">Estonia</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="VA">Holy See (Vatican City State)</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IM">Isle of Man</option>
                                        <option value="IT">Italy</option>
                                        <option value="JE">Jersey</option>
                                        <option value="XK">Kosovo</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MK">Macedonia</option>
                                        <option value="MT">Malta</option>
                                        <option value="MD">Moldova, Republic of</option>
                                        <option value="MC">Monaco</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="NO">Norway</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="RO">Romania</option>
                                        <option value="SM">San Marino</option>
                                        <option value="RS">Serbia</option>
                                        <option value="CS">Serbia and Montenegro</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="ES">Spain</option>
                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="GB">United Kingdom</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="voornaam" class="form-label">Voornaam</label>
                                    <input type="text" class="form-control" id="voornaam" name="voornaam" required>
                                </div>
                                <div class="mb-3">
                                    <label for="achternaam" class="form-label">Achternaam</label>
                                    <input type="text" class="form-control" id="achternaam" name="achternaam" required>
                                </div>
                                <div class="mb-3">
                                    <label for="zipcode" class="form-label">Postcode</label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode" required>
                                </div>
                                <div class="mb-3">
                                    <label for="huisnummer" class="form-label">Huisnummer</label>
                                    <input type="text" class="form-control" id="huisnummer" name="huisnummer" required>
                                </div>
                                <div class="mb-3">
                                    <label for="straatnaam" class="form-label">Straatnaam</label>
                                    <input type="text" class="form-control" id="straatnaam" name="straatnaam" required>
                                </div>
                                <div class="mb-3">
                                    <label for="plaats" class="form-label">Plaats</label>
                                    <input type="text" class="form-control" id="plaats" name="plaats" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefoon" class="form-label">Telefoon</label>
                                    <input type="text" class="form-control" id="telefoon" name="telefoon" required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr style="position:absolute; top:175%; width:95%; border-top: 2px solid black; left:2.5%;">
        <h3 style="position:absolute; top:180%; left:5%;">Verzendopties</h3>
        <form style="position:absolute; top:185%; left:5%;" required>
            <div class="radio-container">
                <input type="radio" id="thuis" name="verzendoptie" value="thuis">
                <label for="thuis">Thuis laten bezorgen</label>
            </div>
            <div class="radio-container">
                <input type="radio" id="afhalen" name="verzendoptie" value="afhalen" re>
                <label for="afhalen">Afhalen bij de winkel</label>
            </div>
            <div class="radio-container">
                <input type="radio" id="pakketpunt" name="verzendoptie" value="pakketpunt">
                <label for="pakketpunt">Bij een pakketpunt bezorgen</label>
            </div>
        </form>
        <hr style="position:absolute; top:197%; width:95%; border-top: 2px solid black; left:2.5%;">
        <form action="" method="POST">
            <input type="hidden" name="checkout_submit" value="1">
            <button type="submit" name="checkout" value="1" class="checkoutknop btn-primary">Betalen</button>
        </form>

        <?php
        if (isset($_POST['checkout'])) {
            $cart->emptyCart();
            echo "
            <script>
                alert('Your order has been successfully placed!')
                setTimeout(function () {
                    window.location.href = 'index.php';
                }, 10); // Adjust the delay as needed
            </script>
            ";
        }
        ?>
</body>

</html>
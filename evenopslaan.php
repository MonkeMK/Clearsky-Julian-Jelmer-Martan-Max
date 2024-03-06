<div class="container">
    <div class="offcanvas-body">
        <div class="center-content">
            <div class="w-50">
                <h4 class="titel">Delivery Address</h4>
                <div class="form">
                    <form action="checkout.php" method="POST" style="display: flex; flex-direction: column; align-items: center;">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="zipcode" class="form-label">Zip code:</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" required>
                        </div>
                        <button type="submit" name="checkout" value="1" class="btn btn-primary" <?php if (empty($cart->getCart())) {
                            echo "disabled";
                        } ?>>Checkout</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
include("registreren.html");
inlcude("bibliotheek/mailen.php");
inlcude(DBconfig.php);
if(isset($_POST["submit"]))
{
    $melding=" ";
    $voornaam=htmlspecialchars($_POST[voornaam]);
    $achternaam=htmlspecialchars($_POST[achternaam]);
    $klant=$voornaam . " " .$achternaam;
    $straat=htmlspecialchars($_POST[straat]);
    $postcode=htmlspecialchars($POST[postcode]);
    $woonplaats=htmlspecialchars($POST[vwoonplaats]);
    $email=htmlspecialchars($POST[email]);
    $wachtwoord=htmlspecialchars($POST[wachtwoord]);
    $wachtwoordhash=password_hash($wachtwoord, PASSWORD_DEFAULT);
}

// duplicaat email checker
$sql = "SELECT * FROM klant WHERE email = ?";
$stmt = @verbinding->prepare($sql);
$stmt->execute(array($email));
$resultaat = $stmt->fetch(PDO: :FETCH_ASSOC);
if ($resultaat) {
    $melding="Deze email staat al in het systeem";
}else{
    $sql = "INSERT INTO klant (ID, voornaam achternaam
    straat, postcode, woonplaats, email,
    wachtwoord, rol) values (null,?,?,?,?,?,?,?,?,)";
    $stmt=$verbinding->prepare($sql);
    try{
       $stmt->execute(array(
        $voornaam,
        $achternaam,
        $straat,
        $postcode,
        $woonplaats,
        $email,
        $wachtwoordhash,
        0)
       );
       $melding="Nieuw account aangemaakt.";
    } catch(PDOException $e) {
        $melding="Kon geen account maken.";
        $e->getMessage();
    }
    echo "<div id='melding'> .$melding."></div>
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratie Clearsky</title>

    <link rel="stylesheet" href="css/webshop.css">
    <script>src="https://www.google.com/recaptcha/api.js" async defer</script>
</head>
<body>

    <!-- registratie -->
    <div class="content">
    <form name="registreren" class="form" method="POST">
    <p id="pagina_titel"> registreren</p>
    <input type="text" required name="voornaam"
    placeholder="voornaam"/>
    <input type="text" required name="achternaam"
    placeholder="achternaam"/>
    <input type="text" required name="straat"
    placeholder="straat"/>
    <input type="text" required name="postcode"
    placeholder="postcode"/>
    <input type="text" required name="woonplaats"
    placeholder="woonplaats"/>
    <input type="text" required name="e-mail"
    placeholder="e-mail"/>
    <input type="text" required name="wachtwoord"
    placeholder="wachtwoord"/>    
</body>
</html>
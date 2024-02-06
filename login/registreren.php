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
}
?>
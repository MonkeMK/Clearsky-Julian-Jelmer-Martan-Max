<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearsky</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<?php
    include_once("database.php");
    $pdo = connection();
    $id = $_GET["id"];
    $sql = "SELECT * FROM user WHERE id = :id";
    $products = $pdo->prepare($sql);
    $products->bindParam(':id', $id);
    $products->execute();
    
    $product = $products->fetch(PDO::FETCH_ASSOC);
?>

<body>
    <input type="button" class="button" value="<- Terug" onclick="window.location.href='useroverview.php'" />
    <h2 class="edituser">Gebruiker bewerken</h2>
    <form method="post" action="" class="invoervelden">
        <input type="hidden" name="id" value="<?php echo $user_id; ?>">
        <label for="new_username">Nieuwe naam</label><br>
        <input type="text" id="new_username" name="new_username"  value="<?php echo $product["name"] ?>"><br>
        <label for="new_address">Nieuw adres</label><br>
        <input type="text" id="new_address" name="new_address"  value="<?php echo $product["adress"] ?>"><br>
        <label for="new_email">Nieuwe email</label><br>
        <input type="text" id="new_email" name="new_email"  value="<?php echo $product["email"] ?>"><br>
        <label for="new_password">Nieuw wachtwoord</label><br> 
        <input type="text" id="new_password" name="new_password"  value="<?php echo $product["password"] ?>"><br> 
        <label for="new_phone">Nieuw telefoonnummer</label><br>
        <input type="text" id="new_phone" name="new_phone"  value="<?php echo $product["phonenumber"] ?>"><br>
        <label for="new_zipcode">Nieuwe postcode</label><br>
        <input type="text" id="new_zipcode" name="new_zipcode"  value="<?php echo $product["zipcode"] ?>"><br>

        <input class="buttonsubmit" type="submit" name="submit" value="Submit">
    </form>
</body>

<?php
    include_once("php.php");
    update_user();
?>

</html>

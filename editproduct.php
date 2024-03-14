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
    $sql = "SELECT * FROM products WHERE id = :id";
    $products = $pdo->prepare($sql);
    $products->bindParam(':id', $id);
    $products->execute();
    
    $product = $products->fetch(PDO::FETCH_ASSOC);
?>
<body>
    <input type="button" class="button" value="<- Terug" onclick="window.location.href='productoverview.php'" />
    <h2 class="edituser">Producten bewerken</h2>
    <form method="post" action="" class="invoervelden">
        <input type="hidden" name="id" value="<?php echo $user_id; ?>">
        <label for="new_name">Nieuwe naam</label><br>
        <input type="text" id="new_name" name="new_name" value="<?php echo $product["name"] ?>"><br>
        <label for="new_description">Nieuwe beschrijving</label><br>
        <input type="text" id="new_description" name="new_description" value="<?php echo $product["description"] ?>"><br>
        <label for="new_price">Nieuwe prijs</label><br> 
        <input type="text" id="new_price" name="new_price" value="<?php echo $product["price"] ?>"><br> 
        <label for="new_image">Nieuwe image</label><br>
        <input type="text" id="new_image" name="new_image" value="<?php echo $product["image"] ?>"><br>
        <input class="buttonsubmit" type="submit" name="submit" value="Submit">
    </form>
</body>

<?php
    include_once("php.php");
    update_product();
?>

</html>
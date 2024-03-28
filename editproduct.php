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

<?php
include_once("database.php");
$pdo = connection();
$id = $_GET["id"];
$sql = "SELECT * FROM products WHERE id = :id";
$products = $pdo->prepare($sql);
$products->bindParam(':id', $id);
$products->execute();
include_once("php.php");
update_product();

$product = $products->fetch(PDO::FETCH_ASSOC);
?>

<body style="background:#fff;">
    <div class="bovenbalk">
        <div id="popupBar" class="alert alert-danger" style="display: none; background-color: #fff3cd;"></div>
    </div>

    <input type="button" class="buttonback" value="<- Terug" onclick="window.location.href='productoverview.php'" />
    <h2 class="edituser">Producten bewerken</h2>
    <form method="post" action="" class="invoervelden" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $user_id; ?>">
        <label for="new_name">Nieuwe naam</label><br>
        <input type="text" id="new_name" name="new_name" value="<?php echo $product["name"] ?>"><br>
        <label for="new_description">Nieuwe beschrijving</label><br>
        <input type="text" id="new_description" name="new_description"
            value="<?php echo $product["description"] ?>"><br>
        <label for="new_price">Nieuwe prijs</label><br>
        <input type="text" id="new_price" name="new_price" value="<?php echo $product["price"] ?>"><br>
        <label for="new_image">Nieuwe image</label><br>
        <input type="file" id="new_image" name="new_image"><br> <!-- File input added here -->
        <input class="buttonsubmit" type="submit" name="submit" value="submit" onclick="return validateForm(event)">
    </form>
</body>

<script>
    function validateForm(event) {
        var new_name = document.getElementById("new_name").value;
        var new_description = document.getElementById("new_description").value;
        var new_price = document.getElementById("new_price").value;
        var new_image = document.getElementById("new_image").value;

        if (new_name.trim() === "" || new_description.trim() === "" || new_price.trim() === "" || new_image.trim() === "") {
            displayPopup("Alle velden moeten ingevuld zijn.");
            event.preventDefault(); // Prevent form submission
            return false;
        }

        return true;
    }


    function displayPopup(message) {
        var popupBar = document.getElementById("popupBar");
        popupBar.innerHTML = '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' + message;
        popupBar.style.display = "block";

        setTimeout(function () {
            popupBar.style.display = "none";
        }, 5000);
    }
</script>

</html>

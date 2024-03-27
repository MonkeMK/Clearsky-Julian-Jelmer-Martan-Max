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
$sql = "SELECT * FROM user WHERE id = :id";
$users = $pdo->prepare($sql);
$users->bindParam(':id', $id);
$users->execute();
include_once("php.php");
update_user();

$user = $users->fetch(PDO::FETCH_ASSOC);
?>

<body style="background:#fff;">
    <div class="bovenbalk">
        <div id="popupBar" class="alert alert-danger" style="display: none; background-color: #fff3cd;"></div>
    </div>

    <input type="button" class="buttonback" value="<- Terug" onclick="window.location.href='useroverview.php'" />
    <h2 class="edituser">Gebruiker bewerken</h2>
    <form method="post" action="" class="invoervelden">
        <input type="hidden" name="id" value="<?php echo $user_id; ?>">
        <label for="new_username">Nieuwe naam</label><br>
        <input type="text" id="new_username" name="new_username" value="<?php echo $user["name"] ?>"><br>
        <label for="new_address">Nieuw adres</label><br>
        <input type="text" id="new_address" name="new_address" value="<?php echo $user["adress"] ?>"><br>
        <label for="new_email">Nieuwe email</label><br>
        <input type="text" id="new_email" name="new_email" value="<?php echo $user["email"] ?>"><br>
        <label for="new_password">Nieuw wachtwoord</label><br>
        <input type="text" id="new_password" name="new_password" value="<?php echo $user["password"] ?>"><br>
        <label for="new_phone">Nieuw telefoonnummer</label><br>
        <input type="text" id="new_phone" name="new_phone" value="<?php echo $user["phonenumber"] ?>"><br>
        <label for="new_zipcode">Nieuwe postcode</label><br>
        <input type="text" id="new_zipcode" name="new_zipcode" value="<?php echo $user["zipcode"] ?>"><br>

        <input class="buttonsubmit" type="submit" name="submit" value="Submit" onclick="return validateForm(event)">
    </form>
</body>

<script>
    function validateForm(event) {
        var new_username = document.getElementById("new_username").value;
        var new_address = document.getElementById("new_address").value;
        var new_email = document.getElementById("new_email").value;
        var new_password = document.getElementById("new_password").value;
        var new_phone = document.getElementById("new_phone").value;
        var new_zipcode = document.getElementById("new_zipcode").value;

        if (new_username.trim() === "" || new_address.trim() === "" || new_email.trim() === "" || new_password.trim() === "" || new_phone.trim() === "" || new_zipcode.trim() === "") {
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

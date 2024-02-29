<!DOCTYPE html>
<html lang="en">

<?php
include_once("header.php");
include_once("database.php");
$conn = connection();
include_once("php.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handleAfspraak($conn);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link rel="stylesheet" href="css/afspraak.css">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</head>



<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="titel">Maak een afspraak</h1>
                <form id="myForm" method="post">
                    <label class="naamtext" for="name">Naam</label>
                    <input class="naam" type="text" placeholder="naam" name="name">
                    <label class="datetext" for="datum">Datum:</label><br>
                    <input class="date" type="date" id="date" name="date"><br>
                    <label class="beschrijvingtext" for="beschrijvinigtext">Beschrijving:</label><br>
                    <textarea class="beschrijving" id="description" name="description"></textarea><br><br>
                    <button class="button" type="submit">Verzenden</button>
                </form>

            </div>
        </div>
    </div>
    
</body>

</html>

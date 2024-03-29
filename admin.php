<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <?php
        include_once("database.php");
        include_once("header.php");
    ?>
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background:#fff;">
    <div class="containeradmin">
        <input type="button" class="userbutton" value="Gebruikers" onclick="window.location.href='useroverview.php';">
        <input type="button" class="productbutton" value="Producten"
            onclick="window.location.href='productoverview.php';">
        <input type="button" class="afspraakbutton" value="Afspraken"
            onclick="window.location.href='afspraakoverview.php';">
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</html>

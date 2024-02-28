<!DOCTYPE html>
<html lang="en">
<?php
include_once("header.php");
include_once("database.php");
$conn = connection();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link rel="stylesheet" href="css/afspraak.css">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</head>

</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Maak een afspraak</h1>
                <form action="afspraak.php" method="post">
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                </form>
            </div>

<h2>Voer een datum en beschrijving in:</h2>

<form id="myForm">
  <label for="datum">Datum:</label><br>
  <input type="date" id="datum" name="datum"><br>
  <label for="beschrijving">Beschrijving:</label><br>
  <textarea class="beschrijving" id="beschrijving" name="beschrijving"></textarea><br><br>
  <button type="button" onclick="submitForm()">Verzenden</button>
</form>

<script>
function submitForm() {
  var datum = document.getElementById("datum").value;
  var beschrijving = document.getElementById("beschrijving").value;
  
  // Maak een nieuwe blanco pagina aan en stuur de gegevens daar naartoe
  var newWindow = window.open('', '_blank');
  newWindow.document.write("<h2>Ingevoerde gegevens:</h2>");
  newWindow.document.write("<p><strong>Datum:</strong> " + datum + "</p>");
  newWindow.document.write("<p><strong>Beschrijving:</strong> " + beschrijving + "</p>");
}
</script>
</body>
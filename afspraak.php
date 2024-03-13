<!DOCTYPE html>
<html lang="en">

<?php
include_once("header.php");
include_once("database.php");
print_r($_SESSION);
$conn = connection();
include_once("php.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handleAfspraak($conn); 
}


// receive from database
$query = "SELECT date FROM afspraken";
$stmt = $conn->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

// create array with dates only
$dates = array();
foreach ($results as $row) {
    array_push($dates, $row['date']);   
}

// php array to json array
$json_encoded = json_encode($dates);

// putting json array into session storage 
echo "<script>sessionStorage.setItem('unavailable_setad', '$json_encoded')</script>";
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



<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="titel">Maak een afspraak</h1>
                <form id="myForm" method="post">
                    <label class="naamtext" for="name">Naam</label>
                    <input class="naam" type="text" placeholder="naam" name="name">
                    <label class="datetext" for="datum">Datum:</label><br>
                    <input class="date" type="date" id="date" name="date" oninput="on_date_input(this)"><br>
                    <label class="beschrijvingtext" for="beschrijvinigtext">Beschrijving:</label><br>
                    <textarea class="beschrijving" id="description" name="description"></textarea><br><br>
                    <button disabled id="disabled-button" name="button" class="button"  type="submit">Verzenden</button>
                </form>

            </div>
        </div>
    </div>

    <script>
        const unavailable_setad = sessionStorage.getItem('unavailable_setad');
        console.log(unavailable_setad)

        function on_date_input(element) {
            var selectedDate = new Date(element.value);
            var dayOfWeek = selectedDate.getDay();

            console.log(dayOfWeek);

            const button = document.querySelector("#myForm button[name='button']")

            if (dayOfWeek === 0 || dayOfWeek === 6) {
                window.alert('Please select a weekday (Monday to Friday)');
                button.setAttribute("disabled", "disabled");
            }

            if (!unavailable_setad.includes(element.value)) {
                button.removeAttribute("disabled");
            } else {
                window.alert("This date is unavailable, please pick another one.")
                button.setAttribute("disabled", "disabled");
            }
        } 
    </script>
    

<?php
if (isset($GLOBALS["AFSPRAAK_ERROR"])) {
    echo "<script>document.addEventListener('DOMContentLoaded', window.alert('". $GLOBALS["AFSPRAAK_ERROR"] ."'));</script>";
}
?>
</body>

</html>
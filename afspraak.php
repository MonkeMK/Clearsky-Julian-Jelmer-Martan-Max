<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearsky</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../Clearsky-Julian-Jelmer-Martan-Max/css/overons.css">
    <link rel="stylesheet" href="css/afspraak.css" />
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
</head>

<body>
    <?php
    include_once ("header.php");
    include_once ("database.php");
    $conn = connection();
    include_once ("php.php");
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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="titel">Maak een afspraak</h1>
                <form id="myForm" method="post">
                    <label class="naamtext" for="name">Naam</label>
                    <input class="naam" type="text" placeholder="naam" name="name">
                    <label class="datetext" for="datum">Datum:</label><br>
                    <input class="date" type="date" id="date" name="date" oninput="on_date_input(this)"
                        min="<?php echo date('Y-m-d'); ?>"><br>
                    <label class="addresstext" for="address">Adres:</label> <!-- Changed type to "text" -->
                    <input class="address" type="text" placeholder="adres" name="address"> <!-- Added name attribute -->
                    <label class="beschrijvingtext" for="beschrijvinigtext">Beschrijving:</label><br>
                    <textarea class="beschrijving" id="description" name="description"></textarea><br><br>
                    <button disabled id="disabled-button" name="button" class="button" type="submit">Verzenden</button>
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

        function on_date_input(element) {
            var selectedDate = new Date(element.value);
            var currentDate = new Date();

            if (selectedDate < currentDate) {
                window.alert('Please select a future date.');
                element.value = ''; // Clear the input field
                return;
            }

            var dayOfWeek = selectedDate.getDay();

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
    if (isset ($GLOBALS["AFSPRAAK_ERROR"])) {
        echo "<script>document.addEventListener('DOMContentLoaded', window.alert('" . $GLOBALS["AFSPRAAK_ERROR"] . "'));</script>";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>
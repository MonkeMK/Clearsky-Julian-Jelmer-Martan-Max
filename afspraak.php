<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearsky</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/afspraak.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<style>
#datepicker {
    position: absolute;
    top: 37%;
    left: 31%;
    width: 38%;
}
</style>
<body>
    <?php
    include_once("header.php");
    include_once("database.php");
    $conn = connection();
    include_once("php.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        handleAfspraak($conn);
    }

    $query = "SELECT date FROM afspraken";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    $dates = array();
    foreach ($results as $row) {
        array_push($dates, $row['date']);
    }

    $json_encoded = json_encode($dates);


    echo "<script>sessionStorage.setItem('unavailable_setad', '$json_encoded')</script>";
    ?>
    <script>
        // $("#datepicker").datepicker({ beforeShowDay: $.datepicker.noWeekends });
        const dates = sessionStorage.getItem('unavailable_setad');
        $(function() {
            $("#datepicker").datepicker({
                beforeShowDay: function(date) {
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [(dates.indexOf(string) == -1) && ($.datepicker.noWeekends(date)[0])];
                }
            });
        });
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">Maak een afspraak</h1>
                <form id="myForm" method="post">
                    <label class="naamtext" for="name">Naam</label>
                    <input class="naam" type="text" placeholder="naam" name="name">
                    <label class="datetext" for="datepicker">Datum:</label><br>
                    <input type="text" id="datepicker" name="date">
                    <label class="addresstext" for="address">Adres:</label>
                    <input class="address" type="text" placeholder="adres" name="address">
                    <label class="beschrijvingtext" for="beschrijvinigtext">Beschrijving:</label><br>
                    <textarea class="beschrijving" id="description" name="description"></textarea><br><br>
                    <button id="disabled-button" name="button" class="button" type="submit">Verzenden</button>
                </form>
            </div>
        </div>
    </div>

   


    <?php
    if (isset($GLOBALS["AFSPRAAK_ERROR"])) {
        echo "<script>document.addEventListener('DOMContentLoaded', window.alert('" . $GLOBALS["AFSPRAAK_ERROR"] . "'));</script>";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>`

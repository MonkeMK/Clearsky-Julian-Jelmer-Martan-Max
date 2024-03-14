<?php

include_once ("database.php");
$conn = connection();

if (!$conn) {
    die ("Connection failed");
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT name FROM user WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row) {
    $current_username = $row["name"];
} else {
    $current_username = "Guest";
}
$conn = null;

$pdo = connection();
$id = $_SESSION["user_id"];

$sql = "SELECT * FROM user WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();


$product = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = connection();
$user_id = $_SESSION["user_id"];

$query = "SELECT id, name, date, description, address
          FROM afspraken
          WHERE user_id = :user_id
          ORDER BY date DESC";
$stmt = $sql->prepare($query);

$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

$stmt->execute();
if ($stmt->rowCount() > 0) {
    echo "<table>";
    echo "<tr>
            <th>Naam</th>
            <th>Datum</th>
            <th>Beschrijving</th>
            <th>Adres</th>
          </tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Check if the date is in the past
        $date = strtotime($row["date"]);
        $today = strtotime(date("Y-m-d"));
        $date_class = ($date < $today) ? 'past-date' : '';

        echo "<tr class='$date_class'><td>" . $row["name"] . "</td><td>" . $row["date"] . "</td><td>" . $row["description"] . "</td><td>" . $row["address"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No appointments found for the current user.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/user.css">
    <title>Gebruikerspage</title>
</head>

<body>
    <h2 class="editproduct">Afspraken</h2>
    <h1 class="title">Welkom,
        <?php echo $current_username; ?>!
    </h1>
    <form method="post" action="" class="invoervelden">
        <input type="hidden" name="id" value="<?php echo $user_id; ?>">
        <label for="new_username">Nieuwe naam</label><br>
        <input type="text" id="new_username" name="new_username" value="<?php echo $product["name"] ?>"><br>
        <label for="new_address">Nieuw adres</label><br>
        <input type="text" id="new_address" name="new_address" value="<?php echo $product["adress"] ?>"><br>
        <label for="new_email">Nieuwe email</label><br>
        <input type="text" id="new_email" name="new_email" value="<?php echo $product["email"] ?>"><br>
        <label for="new_password">Nieuw wachtwoord</label><br>
        <input type="text" id="new_password" name="new_password" value="<?php echo $product["password"] ?>"><br>
        <label for="new_phone">Nieuw telefoonnummer</label><br>
        <input type="text" id="new_phone" name="new_phone" value="<?php echo $product["phonenumber"] ?>"><br>
        <label for="new_zipcode">Nieuwe postcode</label><br>
        <input type="text" id="new_zipcode" name="new_zipcode" value="<?php echo $product["zipcode"] ?>"><br>

        <input class="buttonsubmit" type="submit" name="submit" value="Submit">
    </form>

    <div class="container">

        <canvas id="lineChart"
            style="position:relative; margin-left:50%; margin-top:8%; max-width:50%; max-height:50%;"></canvas>
        <canvas id="barChart"
            style="position:relative; margin-left:50%; margin-top:2%; max-width:50%; max-height:50%;"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Define array of names for lines and bars
        var lineNames = ['Teruglevering', 'Energieopwekking'];
        var barNames = ['Teruglevering', 'Energieopwekking'];

        // Generate random data points for line chart
        var lineDataSets = [];
        for (var j = 0; j < 2; j++) {
            var lineDataPoints = [];
            for (var i = 0; i < 10; i++) {
                lineDataPoints.push(Math.floor(Math.random() * 300) + 50);
            }
            lineDataSets.push({
                label: lineNames[j], // Use the name from lineNames array
                data: lineDataPoints,
                borderColor: 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',1)',
                backgroundColor: 'rgba(0, 0, 0, 0)',
                borderWidth: 1,
                lineTension: 0.4 // Adjust curvature here
            });
        }

        // Generate random data points for bar chart
        var barDataSets = [];
        for (var j = 0; j < 2; j++) {
            var barDataPoints = [];
            for (var i = 0; i < 10; i++) {
                barDataPoints.push(Math.floor(Math.random() * 300) + 50);
            }
            barDataSets.push({
                label: barNames[j], // Use the name from barNames array
                data: barDataPoints,
                backgroundColor: 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',0.6)',
                borderColor: 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',1)',
                borderWidth: 1
            });
        }

        // Create a line chart
        var ctxLine = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: Array.from(Array(10).keys()), // X-axis labels (0 to 9)
                datasets: lineDataSets
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Create a bar chart
        var ctxBar = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: Array.from(Array(10).keys()), // X-axis labels (0 to 9)
                datasets: barDataSets
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    </script>
</body>

<?php
include_once ("php.php");
update_userpage();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

</html>
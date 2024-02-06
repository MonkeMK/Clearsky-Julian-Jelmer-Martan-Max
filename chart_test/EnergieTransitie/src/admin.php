<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/papaparse@5.4.1"></script>
    <link href="style/style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

} else {
    header("location: login.php");
    exit;
}
?>

<div class="navbar">
        <a href="../index.html">Home</a>
        <a id="login" href="admin.php">login</a>
        <div class="dropup">
            <button class="dropbtn">All charts</button>
            <div class="dropup-content">
                <a href="chart1.html">line graph</a>
                <a href="chart2.html">bar graph</a>
                <a href="source1.html">Sensor 1</a>
                <a href="source2.html">Sensor 2</a>
                <a href="source3.html">Sensor 3</a>
            </div>
        </div>
    </div>


<form id="loginform" class="loginform" method="post" action="insertdata.php">
    <label for="">sensor 1:</label><br>
    <input type="text" id="sensor1" name="sensor1" class="text-input"><br><br>
    <label for="">sensor 2:</label><br>
    <input type="text" id="sensor2" name="sensor2" class="text-input"><br><br>
    <label for="">sensor 3:</label><br>
    <input type="text" id="sensor3" name="sensor3" class="text-input"><br><br>
    <input type="submit" value="Submit">
</form>

<button class="export-button" onclick="exportData()">Export Data</button>

<button class="theme-switch" onclick="switchBackground();">Switch Theme</button>

<script src="../script.js"></script>

<script>
    function exportData() {
        // Get data from server
        $.ajax({
            url: "get_data.php",
            dataType: "json",
            success: function (data) {
                // Convert data to CSV
                var csv = Papa.unparse(data);

                // Create download link
                var link = document.createElement('a');
                link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv));
                link.setAttribute('download', 'data.csv');
                document.body.appendChild(link);

                // Click download link
                link.click();
            }
        });
    }
</script>

</body>
</html>
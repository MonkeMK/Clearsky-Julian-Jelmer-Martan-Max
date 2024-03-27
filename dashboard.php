<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lijn- en staafdiagrammen met Charts.js</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
include_once("header.php");
include_once('database.php');
?>

<body>
    <div class="containerdashboard">
        <h1 class="titeldashboard">Dashboard</h1>
        <canvas id="lineChart" style="position:absolute; top:5%; margin-top:5%; width:20%; height:8%;"></canvas>
        <hr class="tussenlijn">
        <canvas id="barChart" style="position:absolute; top:35%; margin-top:15%; width:20%; height:8%;"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Array met namen voor lijnen en staafjes definiëren
        var lineNames = ['Basis bundel clearsky', 'Sloppe bundel', 'Luxe pakket', 'Konings bundel', 'Licht bundel', 'Gaymer bundel'];
        var barNames = ['Basis bundel clearsky', 'Sloppe bundel', 'Luxe pakket', 'Konings bundel', 'Licht bundel', 'Gaymer bundel'];

        // Willekeurige datapunten genereren voor lijndiagram
        var lineDataSets = [];
        for (var j = 0; j < 6; j++) {
            var lineDataPoints = [];
            for (var i = 0; i < 10; i++) {
                lineDataPoints.push(Math.floor(Math.random() * 300) + 50);
            }
            lineDataSets.push({
                label: lineNames[j], // Gebruik de naam uit de lineNames-array
                data: lineDataPoints,
                borderColor: 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',1)',
                backgroundColor: 'rgba(0, 0, 0, 0)',
                borderWidth: 1,
                lineTension: 0.4 // Hier de kromming aanpassen
            });
        }

        // Willekeurige datapunten genereren voor staafdiagram
        var barDataSets = [];
        for (var j = 0; j < 6; j++) {
            var barDataPoints = [];
            for (var i = 0; i < 10; i++) {
                barDataPoints.push(Math.floor(Math.random() * 300) + 50);
            }
            barDataSets.push({
                label: barNames[j], // Gebruik de naam uit de barNames-array
                data: barDataPoints,
                backgroundColor: 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',0.6)',
                borderColor: 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',1)',
                borderWidth: 1
            });
        }

        // Lijndiagram maken
        var ctxLine = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: Array.from(Array(10).keys()), // X-as labels (0 tot 9)
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

        // Staafdiagram maken
        var ctxBar = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: Array.from(Array(10).keys()), // X-as labels (0 tot 9)
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

<footer class="onderbalkdashboard text-lg-start bg-light text-muted">
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        <b>&copy Auteursrecht door Clearsky</b>
    </div>
</footer>

</html>
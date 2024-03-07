<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line and Bar Graphs with Charts.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/dashboard.css">
    <?php
    include_once("header.php");
    include_once('database.php');

    ?>
</head>

<body>

    <div class="container">
        <h1 class="title">Dashboard verkoopcijfers</h1>
        <canvas id="lineChart" style="margin-top:5%; width:40%; height:20%;"></canvas>
        <hr class="tussenlijn">
        <canvas id="barChart" style="margin-top:15%; width:40%; height:20%;"></canvas>
    </div>

    <script>
        // Define array of names for lines and bars
        var lineNames = ['Basis bundel clearsky', 'Sloppe bundel', 'Luxe pakket', 'Konings bundel', 'Licht bundel', 'Gaymer bundel'];
        var barNames = ['Basis bundel clearsky', 'Sloppe bundel', 'Luxe pakket', 'Konings bundel', 'Licht bundel', 'Gaymer bundel'];

        // Generate random data points for line chart
        var lineDataSets = [];
        for (var j = 0; j < 6; j++) {
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
        for (var j = 0; j < 6; j++) {
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

<footer class="onderbalk text-lg-start bg-light text-muted">
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            <b>&copy Copyright by Clearsky</b>
        </div>
    </footer>
</html>
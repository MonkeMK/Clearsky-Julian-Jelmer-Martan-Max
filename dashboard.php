<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line and Bar Graphs with Charts.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="lineChart" style="margin-top:5%; width:40%; height:20%;"></canvas>
    <hr style="position:absolute; top:60%; width:95%; border-top: 2px solid black; left:2.5%;">
    <canvas id="barChart" style="margin-top:15%; width:40%; height:20%;"></canvas>

    <script>
        // Generate random data points for line chart
        var lineDataSets = [];
        for (var j = 0; j < 6; j++) {
            var lineDataPoints = [];
            for (var i = 0; i < 10; i++) {
                lineDataPoints.push(Math.floor(Math.random() * 300) + 50);
            }
            lineDataSets.push({
                label: 'Line ' + (j + 1),
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
                label: 'Bar ' + (j + 1),
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
</html>

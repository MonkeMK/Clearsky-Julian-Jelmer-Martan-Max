<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet">
    <title>Document</title>

</head>
<body>

<div class="navbar">
        <a href="../index.html">Home</a>
        <a id="login" href="src/admin.php">login</a>
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
    
    <form id="loginform" method="post" action="loginfunc.php">
      <label for="admin">Username:</label><br>
      <input type="text" id="admin" name="admin"><br><br>
      <label for="password">Password:</label><br>
      <input type="password" id="password" name="password"><br><br>
      <input type="submit" value="Submit">
    </form>

    <button class="theme-switch" onclick="switchBackground();">Switch Theme</button>

    <script src="script.js"></script>

</body>
</html>
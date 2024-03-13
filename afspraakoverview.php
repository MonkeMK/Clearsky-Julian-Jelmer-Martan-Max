<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<?php
include_once("database.php");
include_once("header.php");
$conn = connection();

$sql = "SELECT id, name, date, description FROM afspraken";
$result = $conn->query($sql);

$rows = array(); // Array to hold fetched rows

if ($result->rowCount() > 0) {
    // Fetch data and store in array
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
    }
} else {
    echo "0 results";
}

// Close connection
$conn = null;
?>

<body>
    <input type="button" class="button" value="<- Terug" onclick="window.location.href='admin.php'" />
    <h1 class="title">Afspraken</h1>
    <div class="tabel">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Datum</th>
                    <th>Beschrijving</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Output data into table rows
                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>
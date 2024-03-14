<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php
    include_once ("database.php");
    include_once ("header.php");
    ?>
    <link rel="stylesheet" href="css/admin.css">
</head>

<?php
$conn = connection();

$sql = "SELECT id, name, date, description, address FROM afspraken ORDER BY date DESC";
$result = $conn->query($sql);

$rows = array();

if ($result->rowCount() > 0) {

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
    }
} else {
    echo "0 results";
}


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
                    <th>Adres</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($rows as $row) {

                    $currentDate = date('Y-m-d');
                    $appointmentDate = $row['date'];
                    $isPastDate = ($currentDate > $appointmentDate);

                    $rowClass = ($isPastDate) ? 'past-date' : '';

                    echo "<tr class='$rowClass'>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

</html>
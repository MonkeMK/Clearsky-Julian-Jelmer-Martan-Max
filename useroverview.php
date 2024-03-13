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

$sql = "SELECT id, name, adress, email, password, phonenumber, zipcode FROM user";
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
    <h1 class="title">Admin</h1>
    <div class="tabel">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Adres</th>
                    <th>Email</th>
                    <th>Wachtwoord</th>
                    <th>Telefoonnummer</th>
                    <th>Postcode</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Output data into table rows
                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['adress'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . $row['phonenumber'] . "</td>";
                    echo "<td>" . $row['zipcode'] . "</td>";
                    echo "<td>";
                    echo "<a href='edit.php?id=" . $row['id'] . "' class='knopedit'>Edit</a>";
                    echo "<a href='delete.php?id=" . $row['id'] . "' class='knopdelete'>Delete</a>";
                    echo "</td>";
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
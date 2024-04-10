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
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
$conn = connection();

$sql = "SELECT id, name, description, price, image FROM products";
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

<body style="background:#fff;">
    <input type="button" class="buttonbackproduct" value="<- Terug" onclick="window.location.href='admin.php'" />
    <h2 class="editproduct">Producten</h2>
    <div class="tabel2">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['image'] . "</td>";
                    echo "<td>";
                    echo "<a href='editproduct.php?id=" . $row['id'] . "' class='knopedit'>Edit</a>";
                    echo "<a href='deleteproduct.php?id=" . $row['id'] . "' class='knopdelete'>Delete</a>";
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
<?php include_once("header.php");
include_once("database.php"); ?>

<?php
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1) {
    $sql = "SELECT * FROM user WHERE id = :id";
    $conn = connection();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->fetch();
} else {
    $result = false;
    header("Location: login.php");
}

if ($result['admin'] == 1) {
    include_once('admin.php');
} else {
    include_once('gebruiker.php');
}
?>

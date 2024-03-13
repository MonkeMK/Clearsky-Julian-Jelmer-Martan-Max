<?php include_once("header.php");
include_once("database.php"); ?>
<link rel="stylesheet" href="css/user.css">
</head>

<?php
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1) {
    $sql = "SELECT * FROM user WHERE id = :id";
    $conn = connection();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
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

<footer class="onderbalk text-lg-start bg-light text-muted">
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            <b>&copy Copyright by Clearsky</b>
        </div>
    </footer>
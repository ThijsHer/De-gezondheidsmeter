<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../Assets/CSS/header.css">
    <link rel="stylesheet" href="../../Assets/CSS/main.css">
    <link rel="stylesheet" href="../../Assets/CSS/home.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>De gezondheidsmeter</title>

</head>
<body>
<?php
include "../../scr/includes/header.php";

session_start();
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

    include "../../scr/includes/conn.php";
    $checkAdminQuery = "SELECT admin FROM users WHERE id = '$userID'";
    $result = $conn->query($checkAdminQuery);

    if ($result && $row = $result->fetch_assoc()) {
        $isAdmin = $row['admin'] == 1;
    } else {
        $isAdmin = false;
    }

    $conn->close();
} else {
    $isAdmin = false;
}
?>
<div class="container">
<div class="meter">
    <div class="background">

    </div>
</div>
<div class="buttons">
    <div class="background">
        <a href="scheme.php"><button class="button">Dagschema invullen</button></a>
        <button class="button">Afgelopen dagen</button>

        <?php if ($isAdmin): ?>
            <button id="admin" class="button">Admin</button>
        <?php endif; ?>

        <a href="../includes/logout.php"><button class="button">Uitloggen</button></a>
    </div>
</div>
</div>

</body>
</html>
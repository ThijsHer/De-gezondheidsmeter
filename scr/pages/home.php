<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../Assets/CSS/header.css">
    <link rel="stylesheet" href="../../Assets/CSS/main.css">
    <link rel="stylesheet" href="../../Assets/CSS/home.css">
    <link rel="stylesheet" href="../../Assets/CSS/meter.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>De gezondheidsmeter</title>
</head>
<body>

<script rel="script" src="../../Assets/JS/meter.js"></script>
<?php
include "../../scr/includes/header.php";

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

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

    $totalScoreQuery = "SELECT SUM(score) as totalScore FROM dagschema WHERE users_id = '$userID'";
    $result = $conn->query($totalScoreQuery);

    if ($result && $row = $result->fetch_assoc()) {
        $totalScore = $row['totalScore'];
    }
    if ($totalScore > 18) {
        $totalScore = 18;
    }
    elseif ($totalScore < 0) {
        $totalScore = 0;
    }


    $conn->close();
} else {
    $isAdmin = false;
    $totalScore = 0;
}
?>
<div class="container">
    <div class="meter">
        <div class="background">
            <?php include "../includes/meter.php" ?>
            <div id="totalScore"><?php echo $row['totalScore'];; ?></div>
            <script>
                console.log("Before loop. Total Score:", <?php echo $totalScore; ?>);
                for (let i = 0; i < Math.abs(<?php echo $totalScore; ?>); i++) {
                    console.log("Inside loop. Iteration:", i);
                    increaseSpeed();
                }
                console.log("After loop.");
            </script>
        </div>
    </div>
    <div class="buttons">
        <div class="background">
            <a href="scheme.php">
                <button class="button">Dagschema invullen</button>
            </a>
            <a>
                <button class="button">Afgelopen dagen</button>
            </a>
            <?php if ($isAdmin): ?>
                <a href="adminhome.php">
                    <button id="admin" class="button">Admin</button>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
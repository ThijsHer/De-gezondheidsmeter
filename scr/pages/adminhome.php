<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 1) {
    header('Location: home.php');
    exit();
}

include "../includes/header.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../Assets/CSS/main.css">
    <link rel="stylesheet" href="../../Assets/CSS/header.css">
</head>
<body>
<a href="admin.php">Voeg vragen toe/ pas vragen aan</a>
</body>
</html>

<?php
include "../includes/header.php";
include "../../Assets/Code/AutoLoader.php";

$baseController = new BaseController();

$baseController->checkAdmin();
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
    <link rel="stylesheet" href="../../Assets/CSS/adminhome.css">
</head>
<body>
<div class="welkom">
    <h1>Welkom Admin.</h1>
</div>
<div class="container">
    <a class="a" href="admin.php">Voeg vragen toe/ pas vragen aan</a><br>
    <a class="a" href="adminUsers.php">edit users</a>
</div>
</body>
</html>

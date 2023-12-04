<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "gezondheidsmeter";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName, 3306);

if (!$conn) {
    die("connection Failed: " . mysqli_connect_error());
}
<?php

class connection
{
    public function setConnection() {
        $serverName = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "gezondsheidsmeter";

        $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

        return $conn;
    }
}
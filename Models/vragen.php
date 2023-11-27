<?php

include 'connection.php';

class vragen
{
    private $connection;
    private $tableName = "vragen";

    public $idvragen;
    public $vraag;
    public $uitleg;

    function __construct() {
        $connectionClass = new connection();
        $this->connection = $connectionClass->setConnection();
    }

    public function getQuestions() {
        $query = 'SELECT * FROM ' . $this->tableName;

        $result = $this->connection->query($query);

        $questions = [];

        while ($row = $result->fetch_assoc()) {
            $questions[] = (object) [
                'idvragen' => $row['idvragen'],
                'vraag' => $row['vraag'],
                'uitleg' => $row['uitleg']
            ];
        }

        return $questions;
    }
}
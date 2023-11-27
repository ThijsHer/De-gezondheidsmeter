<?php

include 'connection.php';

class vragen
{
    private $connection;

    private $tableName = "vragen";
    private $tables = ['idvragen','vragen','uitleg'];

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
                $this->tables[0] => $row['idvragen'],
                $this->tables[1] => $row['vraag'],
                $this->tables[2] => $row['uitleg']
            ];
        }

        return $questions;
    }
}
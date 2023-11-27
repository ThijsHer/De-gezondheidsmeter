<?php

require_once 'connection.php';

class antwoorden
{
    private $connection;

    private $tableName = "antwoorden";
    private $tables = ['id','antwoord','score','vragen_idvragen'];

    function __construct() {
        $connectionClass = new connection();
        $this->connection = $connectionClass->setConnection();
    }

    public function getAllAnswer() {
        $query = 'SELECT * FROM ' . $this->tableName;

        $result = $this->connection->query($query);

        $questions = [];

        while ($row = $result->fetch_assoc()) {
            $questions[] = (object) [
                $this->tables[0] => $row[$this->tables[0]],
                $this->tables[1] => $row[$this->tables[1]],
                $this->tables[2] => $row[$this->tables[2]],
                $this->tables[3] => $row[$this->tables[3]]
            ];
        }

        return $questions;
    }
}
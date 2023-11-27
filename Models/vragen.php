<?php

require_once 'connection.php';

class vragen
{
    private $connection;

    private $tableName = "vragen";
    private $tables = ['idvragen','vraag','uitleg'];

    function __construct() {
        $connectionClass = new connection();
        $this->connection = $connectionClass->setConnection();
    }

    public function getAllQuestions() {
        $query = 'SELECT * FROM ' . $this->tableName;

        $result = $this->connection->query($query);

        $questions = [];

        while ($row = $result->fetch_assoc()) {
            $questions[] = (object) [
                $this->tables[0] => $row[$this->tables[0]],
                $this->tables[1] => $row[$this->tables[1]],
                $this->tables[2] => $row[$this->tables[2]]
            ];
        }

        return $questions;
    }
}
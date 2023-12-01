<?php

class categorie
{
    private $connection;

    private $tableName = "categorie";
    private $primaryKey = 'id';
    private $columns = ['id','categorie'];

    function __construct() {
        $connectionClass = new connection();
        $this->connection = $connectionClass->setConnection();
    }

    public function getAllCategory() {
        $query = 'SELECT * FROM ' . $this->tableName;

        $result = $this->connection->query($query);

        $questions = [];

        while ($row = $result->fetch_assoc()) {
            $questions[] = (object) [
                $this->columns[0] => $row[$this->columns[0]],
                $this->columns[1] => $row[$this->columns[1]]
            ];
        }

        return $questions;
    }
}
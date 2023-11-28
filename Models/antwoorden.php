<?php

class antwoorden
{
    private $connection;

    private $tableName = "antwoorden";
    private $primaryKey = 'id';
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

    public function insertAnswer($antwoord, $score, $vraag_id) {
        $sql = "INSERT INTO {$this->tableName} ({$this->tables[1]}, {$this->tables[2]}, {$this->tables[3]}) VALUES (?, ?, ?)";
        $result = $this->connection->prepare($sql);

        // Use individual variables for bind_param
        $result->bind_param('sss', $antwoord, $score, $vraag_id);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAnswer($id) {
        $sql = "DELETE FROM `{$this->tableName}` WHERE {$this->primaryKey} = {$id}";
        $result = $this->connection->prepare($sql);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
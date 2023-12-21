<?php

class antwoorden
{
    private $connection;

    private $tableName = "antwoorden";
    private $primaryKey = 'id';
    private $columns = ['id','antwoord','score','vragen_idvragen'];

    function __construct() {
        $connectionClass = new connection();
        $this->connection = $connectionClass->setConnection();
    }

    public function getAllAnswer() {
        $query = 'SELECT * FROM ' . $this->tableName;

        $result = $this->connection->query($query);

        $answers = [];

        while ($row = $result->fetch_assoc()) {
            $answers[] = (object) [
                $this->columns[0] => $row[$this->columns[0]],
                $this->columns[1] => $row[$this->columns[1]],
                $this->columns[2] => $row[$this->columns[2]],
                $this->columns[3] => $row[$this->columns[3]]
            ];
        }

        return $answers;
    }

    public function insertAnswer($antwoord, $score, $vraag_id) {
        $sql = "INSERT INTO {$this->tableName} ({$this->columns[1]}, {$this->columns[2]}, {$this->columns[3]}) VALUES (?, ?, ?)";
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

    public function deleteAnswerByQuestionId($id) {
        $sql = "DELETE FROM `{$this->tableName}` WHERE vragen_idvragen = {$id}";
        $result = $this->connection->prepare($sql);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
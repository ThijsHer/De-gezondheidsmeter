<?php

class vragen
{
    private $connection;


    private $tableName = "vragen";
    private $primaryKey = 'idvragen';
    private $columns = ['idvragen','vraag','uitleg'];

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
                $this->columns[0] => $row[$this->columns[0]],
                $this->columns[1] => $row[$this->columns[1]],
                $this->columns[2] => $row[$this->columns[2]]
            ];
        }

        return $questions;
    }

    public function getQuestionById($id) {
        $query = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $this->primaryKey . ' = ' . $id;

        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $question = (object) [
                $this->columns[0] => $row[$this->columns[0]],
                $this->columns[1] => $row[$this->columns[1]],
                $this->columns[2] => $row[$this->columns[2]]
            ];

            return $question;
        } else {
            return null;
        }
    }

    public function updateQuestionById($id, $vraag, $uitleg) {
        $sql = "UPDATE {$this->tableName} SET {$this->columns[1]}=?,{$this->columns[2]}=? WHERE {$this->primaryKey} = ?";
        $result = $this->connection->prepare($sql);

        $result->bind_param('ssi', $vraag, $uitleg, $id);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function insertQuestion($vraag, $uitleg) {
        $sql = "INSERT INTO {$this->tableName} ({$this->columns[1]}, {$this->columns[2]}) VALUES (?, ?)";
        $result = $this->connection->prepare($sql);
        $result->bind_param('ss', $vraag, $uitleg);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteQuestion($id) {
        $sql = "DELETE FROM `{$this->tableName}` WHERE {$this->primaryKey} = {$id}";
        $result = $this->connection->prepare($sql);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
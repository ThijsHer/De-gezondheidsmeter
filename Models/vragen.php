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
        $query = 'SELECT * FROM '. $this->tableName;

        $result = $this->connection->query($query);

        $questions = [];

        while ($row = $result->fetch_assoc()) {
            $question = new vragen();
            $question->idvragen = $row['idvragen'];
            $question->vraag = $row['vraag'];
            $question->uitleg = $row['uitleg'];

            // Create an array containing only the specific properties
            $questions[] = [
                'idvragen' => $question->idvragen,
                'vraag' => $question->vraag,
                'uitleg' => $question->uitleg,
            ];
        }

        return $questions;
    }
}
<?php

class users
{
    private $connection;


    private $tableName = "users";
    private $primaryKey = 'id';
    private $columns = ['username', 'password', 'blocked', 'admin'];

    function __construct()
    {
        $connectionClass = new connection();
        $this->connection = $connectionClass->setConnection();
    }

    public function getUserByName($name)
    {
        $query = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $this->columns[0] . ' = "' . $name . '"';

        if ($result = $this->connection->query($query)) {

            $questions = [];

            while ($row = $result->fetch_assoc()) {
                $questions[] = (object)[
                    $this->columns[0] => $row[$this->columns[0]],
                    $this->columns[1] => $row[$this->columns[1]],
                    $this->columns[2] => $row[$this->columns[2]],
                    $this->columns[3] => $row[$this->columns[3]]
                ];
            }

            return $questions;
        } else {
            return false;
        }
    }
}
<?php

class users
{
    private $connection;


    private $tableName = "users";
    private $primaryKey = 'id';
    private $columns = ['id','username', 'password', 'admin', 'blocked'];

    function __construct()
    {
        $connectionClass = new connection();
        $this->connection = $connectionClass->setConnection();
    }

    public function getAllUsers()
    {
        $query = 'SELECT * FROM ' . $this->tableName;

        if ($result = $this->connection->query($query)) {

            $users = [];

            while ($row = $result->fetch_assoc()) {
                $users[] = (object)[
                    $this->columns[0] => $row[$this->columns[0]],
                    $this->columns[1] => $row[$this->columns[1]],
                    $this->columns[2] => $row[$this->columns[2]],
                    $this->columns[3] => $row[$this->columns[3]],
                    $this->columns[4] => $row[$this->columns[4]]
                ];
            }

            return $users;
        } else {
            return false;
        }
    }

    public function getUserByName($name)
    {
        $query = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $this->columns[1] . ' = "' . $name . '"';

        if ($result = $this->connection->query($query)) {

            $users = [];

            while ($row = $result->fetch_assoc()) {
                $users[] = (object)[
                    $this->columns[0] => $row[$this->columns[0]],
                    $this->columns[1] => $row[$this->columns[1]],
                    $this->columns[2] => $row[$this->columns[2]],
                    $this->columns[3] => $row[$this->columns[3]],
                    $this->columns[4] => $row[$this->columns[4]]
                ];
            }

            return $users;
        } else {
            return false;
        }
    }

    public function getUsersByName($name)
    {
        $query = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $this->columns[1] . ' LIKE "' . $name . '%"';

        if ($result = $this->connection->query($query)) {

            $users = [];

            while ($row = $result->fetch_assoc()) {
                $users[] = (object)[
                    $this->columns[0] => $row[$this->columns[0]],
                    $this->columns[1] => $row[$this->columns[1]],
                    $this->columns[2] => $row[$this->columns[2]],
                    $this->columns[3] => $row[$this->columns[3]],
                    $this->columns[4] => $row[$this->columns[4]]
                ];
            }

            return $users;
        } else {
            return false;
        }
    }

    public function insertUser($name, $password, $admin, $blocked) {
        $sql = "INSERT INTO {$this->tableName} ({$this->columns[1]}, {$this->columns[2]}, {$this->columns[3]}, {$this->columns[4]}) VALUES (?, ?, ?, ?)";
        $result = $this->connection->prepare($sql);

        // Use individual variables for bind_param
        $result->bind_param('ssii', $name, $password, $admin, $blocked);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUserById($id, $password, $admin, $blocked) {
        $sql = "UPDATE {$this->tableName} SET `{$this->columns[2]}` = ?, `{$this->columns[3]}` = ?, `{$this->columns[4]}` = ? WHERE {$this->primaryKey} = ?";
        $result = $this->connection->prepare($sql);

        // Use individual variables for bind_param
        $result->bind_param('siii', $password, $admin, $blocked, $id);

        echo $sql;

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUserById($id) {
        $sql = "DELETE FROM `{$this->tableName}` WHERE {$this->primaryKey} = {$id}";
        $result = $this->connection->prepare($sql);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
<?php

class LoginController
{
    public function login($name, $password)
    {
        $connectionClass = new connection();
        $usersClass = new users();

        $safeName = mysqli_real_escape_string($connectionClass->setConnection(), $name);
        $safePassword = mysqli_real_escape_string($connectionClass->setConnection(), $password);

        if ($usersClass->getUserByName($safeName)) {
            $objectsTemp = $usersClass->getUserByName($safeName);
            $user = $objectsTemp[0];

            if ($user->blocked > 0) {
                return 0; // Account is blocked
            } elseif (password_verify($safePassword, $user->password)) {
                return 2; // Successful login
            } else {
                return 1; // Incorrect password
            }
        } else {
            return -1;
        }
    }

    public function getDataByName($name) {
        $connectionClass = new connection();
        $usersClass = new users();

        $safeName = mysqli_real_escape_string($connectionClass->setConnection(), $name);

        return $usersClass->getUserByName($safeName);
    }
}
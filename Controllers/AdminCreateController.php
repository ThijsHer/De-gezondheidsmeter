<?php

class AdminCreateController
{
    public function insertUser($name, $password, $admin, $blocked) {
        $userModel = new users();
        $connectionClass = new connection();

        $temPassword = password_hash($password, PASSWORD_DEFAULT);

        $safeName = mysqli_real_escape_string($connectionClass->setConnection(), $name);
        $safePassword = mysqli_real_escape_string($connectionClass->setConnection(), $temPassword);

        if($userModel->insertUser($safeName,$safePassword,$admin,$blocked)) {
            return true;
        } else {
            return false;
        }
    }
}
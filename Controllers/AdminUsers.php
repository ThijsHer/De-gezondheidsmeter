<?php

class AdminUsers
{
    public function getAllUsers() {
        $UserModel = new users();

        return $UserModel->getAllUsers();
    }

    public function getUsersByName($name) {
        $UserModel = new users();

        return $UserModel->getUsersByName($name);
    }

    public function deleteUserById($id) {
        $UserModel = new users();

        return $UserModel->deleteUserById($id);
    }

    public function updateUserById($id, $password, $admin, $blocked) {
        $UserModel = new users();

        return $UserModel->updateUserById($id, $password, $admin, $blocked);
    }
}
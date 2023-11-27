<?php

include '../Models/vragen.php';

class AdminController
{
    public function getQuestion() {
        $vragen = new vragen();

        return $vragen->getQuestions();
    }
}
<?php

require '../../Models/vragen.php';
require '../../Models/antwoorden.php';

class AdminController
{
    public function getAllQuestions() {
        $vragen = new vragen();

        return $vragen->getAllQuestions();
    }

    public function getAllAnswers() {
        $antwoorden = new antwoorden();

        return $antwoorden->getAllAnswer();
    }
}
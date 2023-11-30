<?php

class AdminEditController
{
    public function getQuestionById($id) {
        $vragen = new vragen();

        return $vragen->getQuestionById($id);
    }

    public function updateQuestionById($id, $vraag, $uitleg) {
        $vragen = new vragen();

        return $vragen->updateQuestionById($id, $vraag, $uitleg);
    }
}
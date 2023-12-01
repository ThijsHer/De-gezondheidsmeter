<?php

class AdminEditController
{
    public function getQuestionById($id) {
        $vragen = new vragen();

        return $vragen->getQuestionById($id);
    }

    public function updateQuestionById($id, $vraag, $uitleg, $categoryId) {
        $vragen = new vragen();

        return $vragen->updateQuestionById($id, $vraag, $uitleg, $categoryId);
    }

    public function getAllCategory() {
        $category =  new categorie();

        return $category->getAllCategory();
    }
}
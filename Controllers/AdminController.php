<?php

class AdminController
{
    public function makeAnswer($antwoord, $score, $vraag_id) {
        $antwoorden = new antwoorden();

        return $antwoorden->insertAnswer($antwoord, $score, $vraag_id);
    }

    private function getAllQuestions() {
        $vragen = new vragen();
        return $vragen->getAllQuestions();
    }

    public function makeQuestion($vraag, $uitleg) {
        $vragen = new vragen();

        return $vragen->insertQuestion($vraag, $uitleg);
    }

    private function getAllAnswers() {
        $antwoorden = new antwoorden();
        return $antwoorden->getAllAnswer();
    }

    public function getCombinedAnswersAndQuestions() {
        $questions = $this->getAllQuestions();
        $answers = $this->getAllAnswers();

        $combinedArray = [];

        foreach ($questions as $question) {
            $questionId = $question->idvragen;
            $combinedArray[$questionId]['question'] = (object) $question; // Convert question object to object

            foreach ($answers as $answer) {
                if ($answer->vragen_idvragen == $questionId) {
                    $combinedArray[$questionId]['answers'][] = (object) $answer; // Convert answer object to object
                }
            }
        }

        // Reindex the array starting from 0
        $combinedArray = array_values($combinedArray);

        return $combinedArray;
    }
}
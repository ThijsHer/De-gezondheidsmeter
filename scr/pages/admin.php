<?php
include '../../Models/vragen.php';

$controller = new vragen();

$data = $controller->getQuestions();

var_dump($data[0]->idvragen);
?>
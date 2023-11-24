<?php
include '../../Models/vragen.php';

$vragen = new vragen();

$data = $vragen->getQuestions();

var_dump($data[0]);
?>
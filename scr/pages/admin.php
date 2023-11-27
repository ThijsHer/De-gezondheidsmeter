<?php
include_once '../../Assets/Code/AutoLoader.php';

$controller = new AdminController();


$data = $controller->getAllQuestions();
$data2 = $controller->getAllAnswers();

foreach ($data as $DataRow) {
    echo $DataRow->vraag . '<br>';
}
foreach ($data2 as $DataRow) {
    echo $DataRow->antwoord . '<br>';
}
?>

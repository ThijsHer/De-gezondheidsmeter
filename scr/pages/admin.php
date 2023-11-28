<?php
include_once '../../Assets/Code/AutoLoader.php';

$controller = new AdminController();
if (isset($_POST['deleteQuestion'])) {
    $controller->deleteQuestion($_POST['question_id']);
}
if (isset($_POST['createQuestion'])) {
    $controller->makeQuestion($_POST['vraag'], $_POST['uitleg']);
}
if (isset($_POST['createAnswer'])) {
    $controller->makeAnswer($_POST['antwoord'], $_POST['score'],$_POST['vraag_id']);
}
if (isset($_POST['deleteAnswer'])) {
    $controller->deleteAnswer($_POST['answer_id']);
}

//$controller->makeQuestion('test','test vraag');

$total = $controller->getCombinedAnswersAndQuestions();

foreach ($total as $record) {
    echo $record['question']->vraag . '<form action="admin.php" method="post"><input type="hidden" name="question_id" value="' . $record['question']->idvragen . '"><input type="submit" name="deleteQuestion"></form>';
    echo '----------' . '<br>';
    ?>
    <form action="admin.php" method="post">
        <input type="hidden" value="<?php echo $record['question']->idvragen ?>" name="vraag_id">
        <input type="text" name="antwoord">
        <select name="score">
            <option value="-1">Niet gezond</option>
            <option value="0">Neutraal</option>
            <option value="1">Gezond</option>
        </select>
        <input type="submit" name="createAnswer">
    </form>
    <?php
    // Check if 'answers' attribute exists and is an array
    if (isset($record['answers']) && is_array($record['answers'])) {
        foreach ($record['answers'] as $DataRow) {
            if (isset($DataRow->antwoord) && $DataRow->antwoord !== null) {
                echo '<div style="display: flex">' . $DataRow->antwoord . '<form action="admin.php" method="post"><input type="hidden" value="' . $DataRow->id . '" name="answer_id"><input type="submit" name="deleteAnswer"></form></div><br>';
            }
        }
    }

    echo '<br>';
}
?>
<form action="admin.php" method="post">
    <label>Vraag</label>
    <input type="text" name="vraag">
    <label>Uitleg</label>
    <input type="text" name="uitleg">
    <input type="submit" name="createQuestion">
</form>
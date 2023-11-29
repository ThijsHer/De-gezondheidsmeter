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
    $controller->makeAnswer($_POST['antwoord'], $_POST['score'], $_POST['vraag_id']);
}
if (isset($_POST['deleteAnswer'])) {
    $controller->deleteAnswer($_POST['answer_id']);
}

$total = $controller->getCombinedAnswersAndQuestions();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="../../Assets/CSS/main.css">
    <link rel="stylesheet" href="../../Assets/CSS/adminvragen.css">
    <link rel="stylesheet" href="../../Assets/CSS/header.css">
</head>

<body>
<?php
include '../includes/header.php';
?>
<div class="container">
    <div class="form">
        <form action="admin.php" method="post">
            <p>Voeg een vraag toe</p> <br />
            <label>Vraag</label><br />
            <input class="typefield" type="text" name="vraag"><br />
            <label>Uitleg</label><br />
            <input class="typefield" type="text" name="uitleg"><br />
            <input type="submit" name="createQuestion" value="Toevoegen"><br />
        </form>
    </div>

    <div class="form">
        <?php
        foreach ($total as $record) {
            echo '<p class="title">' . $record['question']->vraag . '</p><br>';
            ?>
            <form action="admin.php" method="post">
                <input type="hidden" value="<?php echo $record['question']->idvragen ?>" name="vraag_id">
                <input class="typefield" type="text" name="antwoord"><br />
                <select class="select" name="score">
                    <option value="-1">Niet gezond</option>
                    <option value="0">Neutraal</option>
                    <option value="1">Gezond</option>
                </select> <br />
                <input type="submit" name="createAnswer" value="Toevoegen">
            </form>

            <?php
            if (isset($record['answers']) && is_array($record['answers'])) {
                foreach ($record['answers'] as $DataRow) {
                    if (isset($DataRow->antwoord) && $DataRow->antwoord !== null) {
                        echo '<div class="delete-container"><div>' . $DataRow->antwoord . '<form action="admin.php" method="post"><input type="hidden" value="' . $DataRow->id . '" name="answer_id"><input class="delete" type="submit" name="deleteAnswer" value="delete"></form></div><br></div>';
                    }
                }
            }

            echo '<br>';
        }
        ?>
    </div>
</div>
</body>

</html>
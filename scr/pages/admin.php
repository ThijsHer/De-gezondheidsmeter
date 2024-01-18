
<?php
include_once '../../Assets/Code/AutoLoader.php';
include '../includes/conn.php';

$controller = new AdminController();
$baseController = new BaseController();

$baseController->checkAdmin();

if (isset($_POST['deleteQuestionId'])) {
    $questionIdToDelete = $_POST['deleteQuestionId'];

    $sql = "DELETE FROM vragen WHERE idvragen = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $questionIdToDelete);
    $stmt->execute();
    $stmt->close();
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
            <p class="title">Voeg een vraag toe</p> <br/>
            <input class="typefield" type="text" name="vraag" placeholder="Naam vraag"><br/>
            <input class="typefield" type="text" name="uitleg" placeholder="Uitleg vraag"><br/>
            <input type="submit" name="createQuestion" value="Toevoegen"><br/>
        </form>
    </div>
    <div class="form">
        <?php
        foreach ($total as $record) {
            echo '<p class="title">' . $baseController->convertToCapitolFirstChar($record['question']->vraag) . '</p><br>';
            echo '<p class="explanation">' . $baseController->convertToCapitolFirstChar($record['question']->uitleg) . '</p><br>';
            ?>
            <form action="adminBewerken.php" method="get">
                <input type="hidden" value="<?= $record['question']->idvragen ?>" name="id">
                <input class="edit" type="submit" value="Bewerk vraag">
            </form>
            <form action="admin.php" method="post">
                <input type="hidden" value="<?= $record['question']->idvragen ?>" name="deleteQuestionId">
                <input class="delete" type="submit" name="deleteQuestion" value="Delete">
            </form>
            <form action="admin.php" method="post">
                <input type="hidden" value="<?php echo $record['question']->idvragen ?>" name="vraag_id">
                <input class="typefield" type="text" name="antwoord" placeholder="Antwoord"><br/>
                <select class="select" name="score">
                    <option value="-1">Niet gezond</option>
                    <option value="0">Neutraal</option>
                    <option value="1">Gezond</option>
                </select> <br/>
                <input type="submit" name="createAnswer" value="Toevoegen">
            </form>


            <?php
            if (isset($record['answers']) && is_array($record['answers'])) {
                foreach ($record['answers'] as $DataRow) {
                    if (isset($DataRow->antwoord) && $DataRow->antwoord !== null) {
                        ?>
                        <div class="delete-container">
                            <div> <?= $baseController->convertToCapitolFirstChar($DataRow->antwoord); ?>
                                <form action="admin.php" method="post">
                                    <input type="hidden" value="<?= $DataRow->id ?>" name="answer_id">
                                    <input class="delete" type="submit" name="deleteAnswer" value="delete">
                                </form>
                            </div>
                        </div>
                    <?php }
                }
            }
        }
        ?>
    </div>

</div>
</body>

</html>
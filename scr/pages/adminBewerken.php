<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 1) {
    header('Location: home.php');
    exit();
}

include '../../Assets/Code/AutoLoader.php';

$baseController = new BaseController();
$controller = new AdminEditController();

if (isset($_POST['saveEdit'])) {
    if($controller->updateQuestionById($_POST['id'], $_POST['question'],$_POST['explanation'], $_POST['category_id'])) {
        $baseController->redirect('admin.php',null);
    } else {
        $parameter = [
                'id' => $_POST['id']
        ];
        $baseController->redirect('adminBewerken.php',null,$parameter);
    }
} else {
    $row = $controller->getQuestionById($_GET['id']);
    $selectedCategoryId = $row->categorie_id;
    $categoryObject = $controller->getAllCategory();

    var_dump($categoryObject);
}
?>
<form action="adminBewerken.php" method="post">
    <input type="hidden" value="<?= $row->idvragen ?>" name="id">
    <input type="text" value="<?= $row->vraag ?>" name="question">
    <input type="text" value="<?= $row->uitleg ?>" name="explanation">
    <select name="category_id">
        <option>Selecteer een optie</option>
        <?php
        foreach ($categoryObject as $row) {
            if ($row->id === $selectedCategoryId) {
                echo '<option value="' . $row->id . '" selected>' . $baseController->convertToCapitolFirstChar($row->categorie) . '</option>';
            } else {
                echo '<option value="' . $row->id . '">' . $baseController->convertToCapitolFirstChar($row->categorie) . '</option>';
            }
        }
        ?>
    </select>
    <input type="submit" name="saveEdit">
</form>

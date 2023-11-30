<?php
include '../../Assets/Code/AutoLoader.php';

$baseController = new BaseController();
$controller = new AdminEditController();

if (isset($_POST['saveEdit'])) {
    if($controller->updateQuestionById($_POST['id'], $_POST['question'],$_POST['explanation'])) {
        $baseController->redirect('admin.php');
    } else {
        $parameter = [
                'id' => $_POST['id']
        ];
        $baseController->redirect('adminBewerken.php',$parameter);
    }
} else {
    $row = $controller->getQuestionById($_GET['id']);
}
?>
<form action="adminBewerken.php" method="post">
    <input type="hidden" value="<?= $row->idvragen ?>" name="id">
    <input type="text" value="<?= $row->vraag ?>" name="question">
    <input type="text" value="<?= $row->uitleg ?>" name="explanation">
    <input type="submit" name="saveEdit">
</form>

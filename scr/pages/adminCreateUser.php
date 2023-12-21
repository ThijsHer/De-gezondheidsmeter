<?php
include "../../Assets/Code/AutoLoader.php";

$baseController = new BaseController();
$controller = new AdminCreateController();

$baseController->checkAdmin();

if (isset($_POST['addUser'])) {
    $feedback = "";

    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];
    $newAdmin = $_POST['newAdmin'];

    if($controller->insertUser($newUsername,$newPassword,$newAdmin,0)) {
        $feedback = "Gebruiker succesvol toegevoegd";
    } else {
        $feedback = "Gebruiker fout gegaan met toevoegen";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usernames Table</title>
    <link rel="stylesheet" href="../../Assets/CSS/main.css">
    <link rel="stylesheet" href="../../Assets/CSS/adminvragen.css">
    <link rel="stylesheet" href="../../Assets/CSS/adminUser.css">
    <link rel="stylesheet" href="../../Assets/CSS/header.css">
</head>

<body>
<?php include "../includes/header.php";
?>
<div>
</div>
<form class="form" action="" method="post">
    <h1>Create user</h1>
    <label for="newUsername">Username:</label><br>
    <input class="typefield" type="text" name="newUsername" ><br>
    <label for="newPassword">Password:</label><br>
    <input class="typefield" type="password" name="newPassword" ><br>
    <label for="newAdmin">Admin:</label><br>
    <select class="select" name="newAdmin">
        <option value="0">Gebruiker</option>
        <option value="1">Admin</option>
    </select><br>
    <button type="submit" name="addUser">Add User</button>
</form>


</body>

</html>
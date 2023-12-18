<?php
include "../../Controllers/BaseController.php";

$baseController = new BaseController();

$baseController->checkAdmin();

if ($conn->connect_error) {
    die($conn->connect_error);
}

$feedback = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addUser'])) {
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];
    $newAdmin = $_POST['newAdmin'];

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $insertSql = "INSERT INTO users (username, password, admin, blocked) VALUES ('$newUsername', '$hashedPassword', $newAdmin, 0)";
    if ($conn->query($insertSql) === TRUE) {
        $feedback = "User added successfully";
    } else {
        $feedback = "Error adding user: " . $conn->error;
    }
}

$conn->close();
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
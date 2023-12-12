<?php

session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 1) {
    header('Location: login.php');
    exit();
}

include "../includes/conn.php";

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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $userId = $_POST['id'];
    $newPassword = $_POST['newPassword'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $blocked = $_POST['blocked'];
    $admin = $_POST['admin'];

    $updateSql = "UPDATE users SET password = '$hashedPassword', blocked = $blocked, admin = $admin WHERE id = $userId";

    if ($conn->query($updateSql) === TRUE) {
        $feedback = "Record updated successfully";
    } else {
        $feedback = "Error updating record: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $userId = $_POST['id'];

    $deleteSql = "DELETE FROM users WHERE id = $userId";

    if ($conn->query($deleteSql) === TRUE) {
        $feedback = "User deleted successfully";
    } else {
        $feedback = "Error deleting user: " . $conn->error;
    }
}

$sql = "SELECT id, username, password, admin, blocked FROM users";

$search = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($search)) {
    $sql .= " WHERE username LIKE '%$search%'";
}

$result = $conn->query($sql);

$users = array();
while ($row = $result->fetch_assoc()) {
    $hashedPassword = $row['password'];
    $unhashedPassword = password_hash($hashedPassword, PASSWORD_DEFAULT);

    $users[] = array(
        'id' => $row['id'],
        'username' => $row['username'],
        'password' => $unhashedPassword,
        'admin' => $row['admin'],
        'blocked' => $row['blocked']
    );
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit users</title>
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


<form class="form search" action="" method="get">
    <label for="search">Search by Username:</label>
    <input class="typefield" type="text" name="search" placeholder="Enter username">
    <button type="submit">Search</button>
</form>

<table class="form">
    <thead>
    <tr>
        <th>Username</th>
        <th>Password</th>
        <th>Blocked</th>
        <th>Admin</th>
        <th>Save</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <form class="form" action="" method="post">
                <td><input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <input class="typefield" value="<?= htmlspecialchars($user['username']) ?>"></td>
                <td>
                    <input class="typefield" type="password" name="newPassword" placeholder="Enter new password">
                </td>
                <td>
                    <select class="select" name="blocked">
                        <option value="0" <?= $user['blocked'] == 0 ? 'selected' : '' ?>>Allowed</option>
                        <option value="1" <?= $user['blocked'] == 1 ? 'selected' : '' ?>>Blocked</option>
                    </select>
                </td>
                <td>
                    <select class="select" name="admin">
                        <option value="0" <?= $user['admin'] == 0 ? 'selected' : '' ?>>Gebruiker</option>
                        <option value="1" <?= $user['admin'] == 1 ? 'selected' : '' ?>>Admin</option>
                    </select>
                </td>
                <td><button type="submit" name="save">Save</button></td>
            </form>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <td><button class="delete" type="submit" name="delete">Delete</button></td>
            </form>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>

</html>
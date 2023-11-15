<?php
session_start();
include "../includes/conn.php";

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $username);
    $statement->execute();
    $statement->bind_result($id, $fetchedUsername, $hashedPassword);
    $statement->fetch();

    if ($fetchedUsername === $username) {
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $fetchedUsername;
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Invalid username.";
    }

    $statement->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../../Assets/CSS/login.css">
    <link rel="stylesheet" href="../../Assets/CSS/main.css">
</head>
<body>

<div class="login">
    <div class="form">
        <h1>Login</h1>
        <?php
        if ($error_message !== '') {
            echo '<p style="color: red;">' . $error_message . '</p>';
        }
        ?>
        <form action="" method="post">
            <label>Username</label>
            <input name="username" type="text" class="logininput">
            <label>Password</label>
            <input name="pwd" type="password" class="logininput">
            <button type="submit" name="submit" class="button">Login</button>
            <button class="button"> <a href="login.php">Sign up</a></button>
        </form>
    </div>
</div>

</body>
</html>
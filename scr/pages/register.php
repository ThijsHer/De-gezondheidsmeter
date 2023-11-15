<?php
session_start();
include "../includes/conn.php";

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['pwd']);

    if (empty($username) || empty($password)) {
        $error_message = "Please fill in both username and password.";
    } else {
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        $check_username_sql = "SELECT id FROM users WHERE username = ?";
        $check_statement = $conn->prepare($check_username_sql);
        $check_statement->bind_param('s', $username);
        $check_statement->execute();
        $check_statement->store_result();

        if ($check_statement->num_rows > 0) {
            $error_message = "Username already taken. Please choose another.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO users (username, password, admin, blocked) VALUES (?, ?, 0, 0)";
            $insert_statement = $conn->prepare($insert_sql);
            $insert_statement->bind_param('ss', $username, $hashed_password);

            if ($insert_statement->execute()) {
                // Registration successful
                $_SESSION['user_id'] = $insert_statement->insert_id;
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                $error_message = "Error (´。＿。｀)";
            }
        }

        $check_statement->close();
        $insert_statement->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="../../Assets/CSS/login.css">
    <link rel="stylesheet" href="../../Assets/CSS/main.css">
</head>
<body>

<div class="login">
    <div class="form">
        <h1>Register</h1>
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
            <button type="submit" name="submit" class="button">Register</button>
            <button class="button"><a href="login.php">Login</a></button>
        </form>

    </div>
</div>

</body>
</html>

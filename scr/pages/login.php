<?php
include '../../Assets/Code/AutoLoader.php';

$controller = new LoginController();
$baseController = new BaseController();

$error_message = '';

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $result = $controller->login($_POST['username'], $_POST['pwd']);
//
//    if ($result === 2) {
//        //echo 'suka blyad';
//        //$baseController->redirect('home.php', null);
//        header('Location: home.php');
//        exit;
//    } elseif ($result === 1) {
//        $error_message = 'Combinatie fout';
//    } elseif ($result === 0) {
//        $error_message = 'Account geblokkeerd';
//    } else {
//        $error_message = 'Gebruiker niet gevonden';
//    }
//}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['pwd']);

    $sql = "SELECT id, username, password, blocked, admin FROM users WHERE username = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $username);
    $statement->execute();
    $statement->bind_result($id, $fetchedUsername, $hashedPassword, $blocked, $user_role);
    $statement->fetch();

    if ($blocked === 1) {
        $error_message = "Account is blocked";
    } elseif ($fetchedUsername === $username && password_verify($password, $hashedPassword)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $fetchedUsername;

        if ($user_role === 1) {
            $_SESSION['user_role'] = 1;
        }

        header("Location: home.php");
        exit();
    } else {
        $error_message = "Invalid username or password";
    }

    $statement->close();
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
            <a href="register.php">
                <button type="button" class="button">Sign up</button>
            </a>
        </form>
    </div>
</div>

</body>
</html>
<?php
include '../../Assets/Code/AutoLoader.php';

$controller = new LoginController();
$baseController = new BaseController();

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = $controller->login($_POST['username'], $_POST['pwd']);

    if ($result === 2) {
        $baseController->redirect('home.php', null);
    } elseif ($result === 1) {
        $error_message = 'Combinatie fout';
    } elseif ($result === 0) {
        $error_message = 'Account geblokkeerd';
    } else {
        $error_message = 'Gebruiker niet gevonden';
    }
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
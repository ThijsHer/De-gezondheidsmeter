<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dag Schema</title>
    <link rel="stylesheet" href="../../Assets/CSS/header.css">
    <link rel="stylesheet" href="../../Assets/CSS/main.css">
    <link rel="stylesheet" href="../../Assets/CSS/scheme.css">
</head>
<body>

<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
} else {
    header("Location: login.php");
    exit();
}

include "../includes/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../includes/conn.php";

    $enteredDate = $_POST["date"];
    $today = date("Y-m-d");

    if ($enteredDate > $today) {
        echo "Error: Entered date cannot be higher than today.";
    } else {
        $totalScore = 0;
        $numberOfQuestions = 0;

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'question_') === 0) {
                $questionId = substr($key, strlen('question_'));
                $answer = $_POST[$key];

                $query2 = "SELECT score FROM antwoorden WHERE vragen_idvragen = $questionId AND antwoord = '$answer'";
                $result2 = $conn->query($query2);

                if ($result2 && $row2 = $result2->fetch_assoc()) {
                    $score = $row2['score'];
                    $totalScore += intval($score);
                    $numberOfQuestions++;
                } else {
                    echo "Error";
                }
            }
        }

        $averageScore = $numberOfQuestions > 0 ? $totalScore / $numberOfQuestions : 0;

        $insertQuery = "INSERT INTO dagschema (score, date, users_id) VALUES ('$averageScore', '$enteredDate', '$userID')";
        if ($conn->query($insertQuery) === TRUE) {
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<div class="container">
    <form method="post" action="">
        <?php
        include "../includes/conn.php";

        if ($conn->connect_error) {
            die("conn failed :( = " . $conn->connect_error);
        }

        $query = "SELECT * FROM vragen";
        $result = $conn->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $questionId = $row['idvragen'];
                $questionText = $row['vraag'];
                $questionExplanation = $row['uitleg'];

                echo "<label for='question_$questionId'>$questionText:</label><br>";

                echo "<select class='input' name='question_$questionId' id='question_$questionId'>";

                $query2 = "SELECT antwoord, score FROM antwoorden WHERE vragen_idvragen = $questionId";
                $result2 = $conn->query($query2);

                if ($result2) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $answer = $row2['antwoord'];
                        $answerScore = $row2['score'];

                        echo "<option value='$answer' data-score='$answerScore'>$answer</option>";
                    }
                } else {
                    echo "Error: " . $conn->error;
                }

                echo "</select><br>";
            }

            $result->free();
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
        ?>

        <label for="date">Date:</label><br>
        <input class="input" type="date" name="date" id="date" required><br>
        <button type="submit">Opslaan</button>
    </form>
</div>
</body>
</html>
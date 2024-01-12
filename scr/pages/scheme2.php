<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dag Schema</title>
    <link rel="stylesheet" href="../../Assets/CSS/header.css">
    <link rel="stylesheet" href="../../Assets/CSS/main.css">
    <link rel="stylesheet" href="../../Assets/CSS/scheme.css">
    <style>
        .hidden {
            display: none;
        }
        .center-label {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .question label {
            display: flex;
            align-items: center;
            font-size: 40px;
            text-align: center;
            width: fit-content;
        }

        .button {
            background-color: #fff;
        }

        .button.selected {
            background-color: blue;
        }

        body, html {
            height: 100%;
            margin: 0;
        }

        .container {
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding: 20px 0;
        }

        .container form {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: fit-content;
        }

        .buttons {
            display: inline;
        }

        button {
            height: 3rem !important;
        }
    </style>
</head>
<body>
<script src="../../Assets/JS/scheme.js" defer></script>

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
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

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'question_') === 0) {
                $questionId = substr($key, strlen('question_'));
                $answer = $_POST[$key];

                $query2 = "SELECT score FROM antwoorden WHERE vragen_idvragen = $questionId AND antwoord = '$answer'";
                $result2 = $conn->query($query2);

                if ($result2 && $row2 = $result2->fetch_assoc()) {
                    $totalScore += intval($row2['score']);
                } else {
                    echo "Error";
                }
            }
        }

        $insertQuery = "INSERT INTO dagschema (score, date, users_id) VALUES ('$totalScore', '$enteredDate', '{$_SESSION['user_id']}')";
        if (!$conn->query($insertQuery)) {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<div class="container">
    <form method="post" action="">
        <div id="questions">
            <div class='counter-div'>1</div>
        <?php
        include "../includes/conn.php";

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT * FROM vragen";
        $result = $conn->query($query);

        if ($result === false) {
            echo "Error executing query: " . $conn->error;
        } else {
            $totalQuestions = $result->num_rows;

            if ($totalQuestions > 0) {

                $questionNumber = 1;

                while ($row = $result->fetch_assoc()) {
                    $questionId = $row['idvragen'];
                    $questionText = $row['vraag'];
                    $questionExplanation = $row['uitleg'];

                    echo "<div data-question-id='$questionId' data-question-number='$questionNumber' class='question " . ($questionNumber > 1 ? "hidden" : "") . "'>";
                    echo "<div class='center-label'><label for='question_$questionId'> $questionText</label></div><div class='buttonWrapper'>";

                    $query2 = "SELECT antwoord, score FROM antwoorden WHERE vragen_idvragen = $questionId";
                    $result2 = $conn->query($query2);

                    if ($result2 === false) {
                        echo "Error executing query: " . $conn->error;
                    } else {
                        while ($row2 = $result2->fetch_assoc()) {
                            $answer = $row2['antwoord'];
                            $answerScore = $row2['score'];

                            echo "<button type='button' class='button' data-answer='$answer' data-score='$answerScore'>$answer</button>";
                        }
                    }

                    echo "</div>";
                    echo "</div>";

                    $questionNumber++;
                }

                $result->free();
            } else {
                echo "No questions found";
            }

            $conn->close();
        }
        ?>
        </div>
        <input class="input" type="date" name="date" id="date" required><br>
        <div class="buttons">
            <button class="save" type="button" onclick="prevQuestion()">Vorige</button>
            <button class="save" type="submit">Opslaan</button>
            <button class="save" type="button" onclick="nextQuestion()">Volgende</button><br />
        </div>
    </form>
</div>

</body>
</html>
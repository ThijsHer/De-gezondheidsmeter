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
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<script>
    function showQuestion(questionId) {
        let questions = document.querySelectorAll(".question");
        questions.forEach(function (question) {
            question.classList.add("hidden");
        });

        let currentQuestion = document.getElementById("question_" + questionId);
        if (currentQuestion) {
            currentQuestion.classList.remove("hidden");
        }
    }

    function nextQuestion(currentQuestionId, totalQuestions) {
        let nextQuestionId = currentQuestionId + 1;
        if (nextQuestionId <= totalQuestions) {
            showQuestion(nextQuestionId);
        }
    }

    function prevQuestion(currentQuestionId) {
        let prevQuestionId = currentQuestionId - 1;
        if (prevQuestionId >= 1) {
            showQuestion(prevQuestionId);
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        showQuestion(1);
    });
</script>


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
        <?php
        include "../includes/conn.php";

        if ($conn->connect_error) {
            die("conn failed :( = " . $conn->connect_error);
        }

        $query = "SELECT * FROM vragen";
        $result = $conn->query($query);

        if ($result) {
            $totalQuestions = $result->num_rows;
            $questionNumber = 1;
            while ($row = $result->fetch_assoc()) {
                $questionId = $row['idvragen'];
                $questionText = $row['vraag'];
                $questionExplanation = $row['uitleg'];

                echo "<div data-question-id='$questionId' data-question-number='$questionNumber' class='question " . ($questionNumber > 1 ? "hidden" : "") . "'>";
                echo "<label for='question_$questionId'>Question ID: $questionId - $questionText:</label><br>";

                $query2 = "SELECT antwoord, score FROM antwoorden WHERE vragen_idvragen = $questionId";
                $result2 = $conn->query($query2);

                if ($result2) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $answer = $row2['antwoord'];
                        $answerScore = $row2['score'];

                        echo "<button type='button' class='button' data-answer='$answer' data-score='$answerScore'>$answer</button>";
                    }
                } else {
                    echo "Error: " . $conn->error;
                }

                echo "</div>";

                $questionNumber++;
            }

            $result->free();
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
        ?>


        <button class="save" type="button" onclick="prevQuestion()">Previous</button>
        <button class="save" type="submit">Opslaan</button>
        <button class="save" type="button" onclick="nextQuestion()">Next</button><br />
        <label for="date">Date:</label><br>
        <input class="input" type="date" name="date" id="date" required><br>

    </form>
</div>

<script>
    var currentQuestion = 1;
    var totalQuestions = <?= $totalQuestions ?>;

    function showQuestion(questionNumber) {
        var questions = document.querySelectorAll(".question");
        questions.forEach(function (question) {
            question.classList.add("hidden");
        });

        var currentQuestionElement = document.querySelector("[data-question-number='" + questionNumber + "']");
        if (currentQuestionElement) {
            currentQuestionElement.classList.remove("hidden");
        }
    }

    function nextQuestion() {
        currentQuestion++;
        if (currentQuestion <= totalQuestions) {
            showQuestion(currentQuestion);
        } else {
            currentQuestion = totalQuestions;
        }
    }

    function prevQuestion() {
        currentQuestion--;
        if (currentQuestion >= 1) {
            showQuestion(currentQuestion);
        } else {
            currentQuestion = 1;
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        showQuestion(currentQuestion);

        var answerButtons = document.querySelectorAll(".answer-button");
        answerButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                var selectedAnswerInput = document.getElementById("selected_answer");
                selectedAnswerInput.value = button.getAttribute("data-answer");

                // document.querySelector("form").submit();
            });
        });
    });
</script>

</body>
</html>
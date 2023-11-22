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
include "../includes/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../includes/conn.php";

    $enteredDate = $_POST["date"];
    $today = date("Y-m-d");

    if ($enteredDate > $today) {
        echo "Error: Entered date cannot be higher than today.";
    } else {
        echo "test submit";
    }
}

?>

<div class="container">
    <form method="post" action="">
        <?php
        include "../includes/conn.php";

        if ($conn->connect_error) {
            die("conn failed: " . $conn->connect_error);
        }

        $query = "SELECT * FROM vragen";
        $result = $conn->query($query);

        $query2 = "SELECT * FROM antwoorden";
        $result2 = $conn->query($query2);

        if ($result && $result2) {
            while ($row = $result->fetch_assoc()) {
                $questionId = $row['idvragen'];
                $questionText = $row['vraag'];
                $questionExplanation = $row['uitleg'];

                echo "<label for='question_$questionId'>$questionText:</label><br>";

                echo "<select name='question_$questionId' id='question_$questionId'>";

                while ($row2 = $result2->fetch_assoc()) {
                    if ($row2['vragen_idvragen'] == $questionId) {
                        $answer = $row2['antwoord'];
                        $answerScore = $row2['score'];

                        echo "<option value='$answer' data-score='$answerScore'>$answer</option>";
                    }
                }

                echo "</select><br>";
            }

            $result->free();
            $result2->data_seek(0);
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
        ?>

        <label for="date">Date:</label><br>
        <input type="date" name="date" id="date" required><br>
        <button type="submit">Opslaan</button>
    </form>
</div>
</body>
</html>
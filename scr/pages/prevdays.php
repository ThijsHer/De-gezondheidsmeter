<?php
include "../includes/header.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "../includes/conn.php";

$user_id = $_SESSION['user_id'];

$searchDate = isset($_GET['search_date']) ? $_GET['search_date'] : '';

$showAll = isset($_GET['show_all']);

$query = "SELECT DISTINCT DATE(date) as date FROM dagschema WHERE users_id = ?";
if (!empty($searchDate) && !$showAll) {
    $query .= " AND DATE(date) = ?";
}

$stmt = $conn->prepare($query);

if (!empty($searchDate) && !$showAll) {
    $stmt->bind_param("is", $user_id, $searchDate);
} else {
    $stmt->bind_param("i", $user_id);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afgelopen dagen</title>
    <link rel="stylesheet" href="../../Assets/CSS/main.css">
    <link rel="stylesheet" href="../../Assets/CSS/header.css">
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .card {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
            width: 40%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            text-align: center;
        }

        .card h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .card ul {
            list-style: none;
            padding: 0;
        }

        .card li {
            margin-bottom: 8px;
        }

        .search-bar {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-right: 10px;
        }

        input[type="date"] {
            padding: 8px;
            font-size: 14px;
            margin-right: 10px;
        }

        button {
            padding: 10px;
            font-size: 14px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #007BFF;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        button[name="show_all"] {
            background-color: #FFC107;
            margin-top: 10px;
        }

        button[name="show_all"]:hover {
            background-color: #FFA000;
        }

        form {
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Afgelopen dagen</h1>

    <div class="search-bar">
        <form method="get" action="">
            <label for="search_date">Zoek op datum:</label>
            <input type="date" id="search_date" name="search_date" value="<?= $searchDate ?>">
            <button type="submit">Zoeken</button>
            <button type="submit" name="show_all" value="1">Toon alles</button>
        </form>
    </div>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date = $row['date'];

            $stmtScores = $conn->prepare("SELECT score FROM dagschema WHERE users_id = ? AND DATE(date) = ?");
            $stmtScores->bind_param("is", $user_id, $date);
            $stmtScores->execute();
            $resultScores = $stmtScores->get_result();

            $scores = [];
            while ($rowScore = $resultScores->fetch_assoc()) {
                $scores[] = $rowScore['score'];
            }

            if (!empty($scores)) {
                echo "<div class='card'>";
                echo "<h2>Datum: $date</h2>";
                echo "<ul>";
                $counter = 1;
                foreach ($scores as $score) {
                    if ($score >= 1 && $score <= 6) {
                        $finalscore = "Gezonde meting";
                    } elseif ($score > 6 && $score <= 12) {
                        $finalscore = "Niet slecht maar het kan beter";
                    } elseif ($score < 12) {
                        $finalscore = "Ongezonde meting";
                    }
                    echo "<li>meting $counter: $finalscore</li>";
                    $counter++;
                }
                echo "</ul>";
                echo "</div>";
            }
        }
    } else {
        echo "<div class='card'>";
        echo "<p>Geen data beschikbaar voor deze dag</p>";
        echo "</div>";
    }

    $stmt->close();
    ?>
</div>

</body>
</html>
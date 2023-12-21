<div class="speedometer-container">
    <div class="center-point"></div>
    <div class="speedometer-center-hide"></div>
    <div class="speedometer-bottom-hide">
        <?php
        include "../includes/conn.php";
        $totalScoreQuery = "SELECT SUM(score) as totalScore FROM dagschema WHERE users_id = '$userID'";
        $result = $conn->query($totalScoreQuery);

        if ($result && $row = $result->fetch_assoc()) {
            $totalScore = $row['totalScore'];
        }
        if ($totalScore >= 18) {
            $feedback = "Je bent ongezond bezig";
        }
        elseif ($totalScore > 9) {
            $feedback = "je bent lekker bezig";
        }
        elseif ($totalScore < 9) {
            $feedback = "je bent gezond bezig";
        }
        
        $conn->close();
        ?>
        <p><?= $feedback ?></p>

    </div>
    <div class="arrow-container">
        <div class="arrow-wrapper speed-0">
            <div class="arrow"></div>
        </div>
    </div>
    <div class="speedometer-scale speedometer-scale-1 active"></div>
    <div class="speedometer-scale speedometer-scale-2"></div>
    <div class="speedometer-scale speedometer-scale-3"></div>
    <div class="speedometer-scale speedometer-scale-4"></div>
    <div class="speedometer-scale speedometer-scale-5"></div>
    <div class="speedometer-scale speedometer-scale-6"></div>
    <div class="speedometer-scale speedometer-scale-7"></div>
    <div class="speedometer-scale speedometer-scale-8"></div>
    <div class="speedometer-scale speedometer-scale-9"></div>
    <div class="speedometer-scale speedometer-scale-10"></div>
    <div class="speedometer-scale speedometer-scale-11"></div>
    <div class="speedometer-scale speedometer-scale-12"></div>
    <div class="speedometer-scale speedometer-scale-13"></div>
    <div class="speedometer-scale speedometer-scale-14"></div>
    <div class="speedometer-scale speedometer-scale-15"></div>
    <div class="speedometer-scale speedometer-scale-16"></div>
    <div class="speedometer-scale speedometer-scale-17"></div>
    <div class="speedometer-scale speedometer-scale-18"></div>
    <div class="speedometer-scale speedometer-scale-19"></div>
</div>
<script src="../../Assets/JS/script.js"></script>
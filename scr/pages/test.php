<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speedometer - HTML, CSS & Javascript</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="speedometer-container">
    <div class="speedometer-text">
        <div class="static">Speed</div>
        <div class="dynamic">
            <span class="km">0</span>
            <span class="unit">KMPH</span>
        </div>
    </div>
    <div class="center-point"></div>
    <div class="speedometer-center-hide"></div>
    <div class="speedometer-bottom-hide"></div>
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
<div class="accelerate-container">
    <button class="increase" onclick="increaseSpeed()">Increase Speed</button>
    <button class="decrease" onclick="decreaseSpeed()">Decrease Speed</button>
</div>
<script src="logic.js"></script>
</body>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


    .speedometer-container {
        width: 300px;
        height: 300px;
        border: 3px solid black;
        border-radius: 50%;
        margin: 50px auto;
        position: relative;
    }

    .center-point {
        width: 20px;
        height: 20px;
        background-color: black;
        border-radius: 50%;
        position: absolute;
        top: 137px;
        left: 137px;
        z-index: 10;
    }

    .speedometer-scale {
        width: 8px;
        height: 280px;
        background-color: black;
        position: absolute;
        left: 143px;
        top: 7px;
    }

    .speedometer-scale-1 {
        transform: rotate(-90deg);
    }
    .speedometer-scale-2 {
        transform: rotate(-80deg);
    }
    .speedometer-scale-3 {
        transform: rotate(-70deg);
    }
    .speedometer-scale-4 {
        transform: rotate(-60deg);
    }
    .speedometer-scale-5 {
        transform: rotate(-50deg);
    }
    .speedometer-scale-6 {
        transform: rotate(-40deg);
    }
    .speedometer-scale-7 {
        transform: rotate(-30deg);
    }
    .speedometer-scale-8 {
        transform: rotate(-20deg);
    }
    .speedometer-scale-9 {
        transform: rotate(-10deg);
    }
    .speedometer-scale-10 {
        transform: rotate(0deg);
    }
    .speedometer-scale-11 {
        transform: rotate(10deg);
    }
    .speedometer-scale-12 {
        transform: rotate(20deg);
    }
    .speedometer-scale-13 {
        transform: rotate(30deg);
    }
    .speedometer-scale-14 {
        transform: rotate(40deg);
    }
    .speedometer-scale-15 {
        transform: rotate(50deg);
    }
    .speedometer-scale-16 {
        transform: rotate(60deg);
    }
    .speedometer-scale-17 {
        transform: rotate(70deg);
    }
    .speedometer-scale-18 {
        transform: rotate(80deg);
    }
    .speedometer-scale-19 {
        transform: rotate(90deg);
        height: 244px;
        top: 25px;
        left: 161px;
    }

    .speedometer-scale-1.active {
        background-color: green;
    }
    .speedometer-scale-2.active {
        background-color: rgb(8, 181, 8);
    }
    .speedometer-scale-3.active {
        background-color: rgb(21, 202, 21);
    }
    .speedometer-scale-4.active {
        background-color: rgb(43, 244, 43);
    }
    .speedometer-scale-5.active {
        background-color: rgb(79, 251, 79);
    }
    .speedometer-scale-6.active {
        background-color: rgb(133, 251, 79);
    }
    .speedometer-scale-7.active {
        background-color: rgb(199, 251, 79);
    }
    .speedometer-scale-8.active {
        background-color: rgb(228, 251, 79);
    }
    .speedometer-scale-9.active {
        background-color: rgb(251, 251, 79);
    }
    .speedometer-scale-10.active {
        background-color: rgb(251, 234, 79);
    }
    .speedometer-scale-11.active {
        background-color: rgb(251, 205, 79);
    }
    .speedometer-scale-12.active {
        background-color: rgb(251, 168, 79);
    }
    .speedometer-scale-13.active {
        background-color: rgb(251, 139, 79);
    }
    .speedometer-scale-14.active {
        background-color: rgb(251, 122, 79);
    }
    .speedometer-scale-15.active {
        background-color: rgb(251, 99, 79);
    }
    .speedometer-scale-16.active {
        background-color: rgb(251, 90, 79);
    }
    .speedometer-scale-17.active {
        background-color: rgb(247, 61, 47);
    }
    .speedometer-scale-18.active {
        background-color: rgb(247, 47, 47);
    }
    .speedometer-scale-19.active {
        background-color: rgb(255, 0, 0);
    }

    .speedometer-center-hide {
        width: 250px;
        height: 250px;
        background-color: white;
        border-radius: 50%;
        position: absolute;
        top: 22px;
        left: 22px;
        z-index: 9;
    }

    .speedometer-bottom-hide {
        width: 320px;
        height: 250px;
        background-color: white;
        position: absolute;
        z-index: 11;
        top: 160px;
        left: -14px;
        border-top: 1px solid;
    }

    .arrow-container {
        width: 160px;
        height: 160px;
        background-color: transparent;
        position: absolute;
        z-index: 12;
        top: 67px;
        left: 67px;
    }

    .arrow-wrapper {
        width: 160px;
        height: 160px;
        background-color: transparent;
        position: relative;
        transition: all 0.4s;
    }

    .arrow {
        width: 110px;
        height: 4px;
        background-color: purple;
        position: absolute;
        top: 78px;
        left: -30px;
    }

    .speed-0 {
        transform: rotate(0deg);
    }
    .speed-10 {
        transform: rotate(10deg);
    }
    .speed-20 {
        transform: rotate(20deg);
    }
    .speed-30 {
        transform: rotate(30deg);
    }
    .speed-40 {
        transform: rotate(40deg);
    }
    .speed-50 {
        transform: rotate(50deg);
    }
    .speed-60 {
        transform: rotate(60deg);
    }
    .speed-70 {
        transform: rotate(70deg);
    }
    .speed-80 {
        transform: rotate(80deg);
    }
    .speed-90 {
        transform: rotate(90deg);
    }
    .speed-100 {
        transform: rotate(100deg);
    }
    .speed-110 {
        transform: rotate(110deg);
    }
    .speed-120 {
        transform: rotate(120deg);
    }
    .speed-130 {
        transform: rotate(130deg);
    }
    .speed-140 {
        transform: rotate(140deg);
    }
    .speed-150 {
        transform: rotate(150deg);
    }
    .speed-160 {
        transform: rotate(160deg);
    }
    .speed-170 {
        transform: rotate(170deg);
    }
    .speed-180 {
        transform: rotate(180deg);
    }

    .accelerate-container {
        margin-top: 120px;
        text-align: center;
    }

    .accelerate-container button {
        width: 200px;
        height: 60px;
        border: none;
        border-radius: 5px;
        margin: 20px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        box-shadow: 5px 5px 5px #c6c6c6;
        color: white;
    }

    .accelerate-container button:active {
        box-shadow: 5px 5px 5px #ffffff;
    }

    .increase {
        background-color: green;
    }

    .decrease {
        background-color: red;
    }

    .speedometer-text {
        width: 180px;
        position: absolute;
        z-index: 20;
        left: 58px;
        top: 60px;
        text-align: center;
        font-weight: bold;
    }

    .static {
        font-size: 18px;
    }

    .dynamic {
        margin-top: 10px;
    }

    .km {
        font-size: 32px;
    }

    .unit {
        font-size: 14px;
        margin-left: 5px;
    }
</style>
<script>
    var speed = 0;
    var prevSpeed = 0;
    var currentScale = 1;

    function increaseSpeed() {
        if (speed < 180) {
            speed = speed + 10;
            addClass();
            currentScale = currentScale + 1;
            changeActive();
            changeText();
        }
    }

    function decreaseSpeed() {
        if (speed > 0) {
            speed = speed - 10;
            addClass();
            changeActive();
            currentScale = currentScale - 1;
            changeText();
        }
    }

    function addClass() {
        let newClass = "speed-" + speed;
        let prevClass = "speed-" + prevSpeed;
        let el = document.getElementsByClassName("arrow-wrapper")[0];
        if (el.classList.contains(prevClass)) {
            el.classList.remove(prevClass);
            el.classList.add(newClass);
        }
        prevSpeed = speed;
    }

    function changeActive() {
        let tempClass = "speedometer-scale-" + currentScale;
        let el = document.getElementsByClassName(tempClass)[0];
        el.classList.toggle("active");
    }

    function changeText() {
        let el = document.getElementsByClassName("km")[0];
        el.innerText = speed;
    }
</script>



</html>
let speed = 0;
let prevSpeed = 0;
let currentScale = 1;

function increaseSpeed() {
    if (speed < 180) {
        speed = speed + 10;
        addClass();
        currentScale = currentScale + 1;
        changeActive();
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

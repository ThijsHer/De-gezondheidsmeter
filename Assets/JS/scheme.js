const questions = document.getElementsByClassName("question").length;
let counterDisplay = document.querySelector('.counter-div');
let counter = 1;

function displayCounter() {
    counterDisplay.innerHTML = counter;
}

function showQuestion(questionId) {
    let questions = document.querySelectorAll(".question");
    questions.forEach(function (question) {
        question.classList.add("hidden");
    });

    let currentQuestion = document.getElementById("questions").children;
    for (const item of currentQuestion) {
        if (item.getAttribute("data-question-number") == questionId) {
            item.classList.remove("hidden");
        }
    }
}

function nextQuestion() {
    if (counter < questions) {
        counter++;
        showQuestion(counter);
        displayCounter();
    }
}

function prevQuestion() {
    if (counter > 1) {
        counter--;
        showQuestion(counter);
        displayCounter();
    }
}

function selectAnswer(button) {
    document.querySelectorAll('.button').forEach(function (btn) {
        btn.classList.remove('selected');
    });

    button.classList.add('selected');

    let questionId = button.closest('.question').getAttribute('data-question-id');
    let hiddenInput = document.getElementById(`question_${questionId}`);
    hiddenInput.value = button.getAttribute('data-score');

    console.log("Selected Answer:", hiddenInput.value);
    console.log("Question ID:", questionId);
}

document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault();

    let formData = new FormData(this);

    for (let pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    this.submit();
});
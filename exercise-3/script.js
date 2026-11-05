
const questions = [
    {
        question: "Which language is used to create web pages?",
        options: ["Python", "HTML", "Java", "C"],
        answer: "HTML"
    },
    {
        question: "What does CSS stand for?",
        options: ["Computer Style Sheet", "Creative Style System", "Cascading Style Sheets", "Colorful Style Sheets"],
        answer: "Cascading Style Sheets"
    },
    {
        question: "Which tag is used for the largest heading?",
        options: ["<h6>", "<head>", "<h1>", "<p>"],
        answer: "<h1>"
    },
    {
        question: "Which language makes web pages interactive?",
        options: ["HTML", "CSS", "JavaScript", "SQL"],
        answer: "JavaScript"
    },
    {
        question: "Which tag creates a hyperlink?",
        options: ["<link>", "<a>", "<href>", "<url>"],
        answer: "<a>"
    },
    {
        question: "Which attribute specifies an image path?",
        options: ["href", "src", "link", "path"],
        answer: "src"
    },
    {
        question: "Which symbol is used for an ID selector in CSS?",
        options: [".", "#", "*", "&"],
        answer: "#"
    },
    {
        question: "Which property changes text color in CSS?",
        options: ["background", "font-size", "color", "text-style"],
        answer: "color"
    },
    {
        question: "Which HTML tag creates a paragraph?",
        options: ["<p>", "<para>", "<text>", "<h1>"],
        answer: "<p>"
    },
    {
        question: "Which method displays a message in JavaScript?",
        options: ["print()", "alert()", "display()", "show()"],
        answer: "alert()"
    },
    {
        question: "Which database language is used to manage MySQL?",
        options: ["HTML", "CSS", "SQL", "XML"],
        answer: "SQL"
    },
    {
        question: "Which tag is used to create a table row?",
        options: ["<td>", "<th>", "<tr>", "<table>"],
        answer: "<tr>"
    },
    {
        question: "Which input type is used for passwords?",
        options: ["text", "password", "hidden", "number"],
        answer: "password"
    },
    {
        question: "Which CSS property adds space inside an element?",
        options: ["margin", "padding", "border", "outline"],
        answer: "padding"
    },
    {
        question: "Which keyword declares a variable in JavaScript?",
        options: ["var", "int", "string", "define"],
        answer: "var"
    },
    {
        question: "Which tag is used to insert a line break?",
        options: ["<hr>", "<br>", "<break>", "<lb>"],
        answer: "<br>"
    },
    {
        question: "Which operator is used for strict equality in JavaScript?",
        options: ["=", "==", "===", "!="],
        answer: "==="
    },
    {
        question: "Which PHP symbol is used before a variable?",
        options: ["#", "$", "@", "&"],
        answer: "$"
    },
    {
        question: "Which HTML tag creates an unordered list?",
        options: ["<ol>", "<li>", "<ul>", "<list>"],
        answer: "<ul>"
    },
    {
        question: "Which function selects an element by ID in JavaScript?",
        options: ["getElementById()", "getElement()", "queryID()", "selectID()"],
        answer: "getElementById()"
    }
];

let currentQuestion = 0;
let score = 0;
let selectedAnswer = "";

function loadQuestion() {
    selectedAnswer = "";

    const q = questions[currentQuestion];

    document.getElementById("question-number").innerText =
        `Question ${currentQuestion + 1} of ${questions.length}`;

    document.getElementById("score").innerText = "Score: " + score;

    document.getElementById("question").innerText = q.question;

    document.getElementById("progress-bar").style.width =
        ((currentQuestion + 1) / questions.length * 100) + "%";

    const optionsDiv = document.getElementById("options");
    optionsDiv.innerHTML = "";

    q.options.forEach(option => {
        const div = document.createElement("div");
        div.className = "option";
        div.innerText = option;

        div.onclick = function() {
            if (selectedAnswer !== "") return;

            selectedAnswer = option;

            document.querySelectorAll(".option").forEach(item => {
                item.classList.remove("selected");
            });

            div.classList.add("selected");
        };

        optionsDiv.appendChild(div);
    });

    document.getElementById("next-btn").innerText =
        currentQuestion === questions.length - 1 ? "Finish Quiz" : "Next";
}

function nextQuestion() {
    if (selectedAnswer === "") {
        alert("Please select an answer!");
        return;
    }

    if (selectedAnswer === questions[currentQuestion].answer) {
        score++;
    }

    currentQuestion++;

    if (currentQuestion < questions.length) {
        loadQuestion();
    } else {
        showResult();
    }
}

function showResult() {
    document.getElementById("quiz").style.display = "none";
    document.getElementById("result").style.display = "block";

    document.getElementById("final-score").innerText =
        "Your Score: " + score + " / " + questions.length;

    let message = "";

    if (score >= 16) {
        message = "Excellent Performance!";
    } else if (score >= 10) {
        message = "Good Job! Keep Practicing.";
    } else {
        message = "Keep Learning and Try Again!";
    }

    document.getElementById("message").innerText = message;
}

function restartQuiz() {
    currentQuestion = 0;
    score = 0;

    document.getElementById("quiz").style.display = "block";
    document.getElementById("result").style.display = "none";

    loadQuestion();
}

loadQuestion();

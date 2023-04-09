const questions = '../data/questions.json';
const getData = async () => {
    const response = await fetch(questions);
    const data = await response.json();
    console.log(data);
    // return JSON.parse(data);
    return data.quiz;
}

let quizpage = document.getElementById('quiz-page');
let resultpage = document.getElementById('results-page');
let numRight = document.getElementById('numRight');
let root = document.querySelector(':root');


//! LEVEL RANGE
const range = 160; 

let player = {
    completedQuestions: [],
    currentQuestions: {}
}

const checkScore = () => {
    num_correct = player.completedQuestions.length; 
    console.log(num_correct);
    numRight.innerText = num_correct;
    let pct = num_correct / 10;
    let lvl = range * pct; 

    let result = 80 - lvl; 
    root.style.setProperty('--height', result + 'px');
}

const createQuestion = ({question, answer, options}, i) => {
    const field = document.createElement('fieldset');
    field.innerHTML = `
    <legend>Question ${i}</legend>
    <p>${question}</p>
    ${options.map((option) => `
        <div>
            <input type="radio" id="option-${option}" name="answer${i}" value="${option}">
            <label for="option-${option}">${option}</label>
        </div>
    `).join('')}
    `;

    return field;
}

const createQuiz = async () => {
    const form = document.getElementById('quiz');
    const quiz = await getData(); 
    const questions = Object.values(quiz); 
console.log('a ',quiz);


     questions.sort( () => Math.random() - 0.5);


    console.log("this is", questions);
    
    let fieldsets = []
    player.currentQuestions = questions.splice(0,10);
    player.currentQuestions.forEach((question, i) => {
        const field = createQuestion(question, i+1);
        console.log(field);
        
        form.querySelector(".questions").appendChild(field);
        fieldsets.push(field)
    });
    form.addEventListener('submit', (ev) => {
        ev.preventDefault();

        for (let i = 0; i < fieldsets.length; i++) {
            const fieldset = fieldsets[i]
            const question = player.currentQuestions[i]

            const chosen = fieldset.querySelector(":checked")
            if (!chosen) continue;

            if (question.answer == chosen.value) {
                player.completedQuestions.push(i);
            }
        }

        quizpage.style.display = 'none';
        resultpage.style.display = 'block';

        checkScore();


    })
}

createQuiz();
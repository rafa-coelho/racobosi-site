const typedTextSpan = document.querySelector(".maquina-escrever");
const cursorSpan = document.querySelector(".cursor");

const textArray = [".NET Developer", "FrontEnd Developer", "React, Flutter & Node.js", "Web Designer", ];
const typingDelay = 70;
const erasingDelay = 70;
const newTextDelay = 2000; // Delay between current and next text
let textArrayIndex = 0;
let charIndex = 0;

function type() {
    if (charIndex < textArray[textArrayIndex].length) {
        if (!cursorSpan.classList.contains("typing")) cursorSpan.classList.add("typing");
        typedTextSpan.textContent += textArray[textArrayIndex].charAt(charIndex);
        charIndex++;
        setTimeout(type, typingDelay);
    } else {
        cursorSpan.classList.remove("typing");
        setTimeout(erase, newTextDelay);
    }
}

function erase() {
    if (charIndex > 0) {
        if (!cursorSpan.classList.contains("typing")) cursorSpan.classList.add("typing");
        typedTextSpan.textContent = textArray[textArrayIndex].substring(0, charIndex - 1);
        charIndex--;
        setTimeout(erase, erasingDelay);
    } else {
        cursorSpan.classList.remove("typing");
        textArrayIndex++;
        if (textArrayIndex >= textArray.length) textArrayIndex = 0;
        setTimeout(type, typingDelay + 1100);
    }
}

function SetToolTips() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

function SetSkillCardsText() {
    const cards = [{
            title: "JavaScript",
            text: "JavaScript é uma linguagem de script muito usada para sites e agora para servidores, APIs e até para aplicativos mobile e desktop!",
            image: "js.svg"
        },
        {
            title: ".NET",
            text: ".NET tem sido a tecnologia mais utilizada pelas empresas por sua potência e por ser multiplataforma,",
            image: "dotnet.png"
        },
        {
            title: "React",
            text: "React é uma biblioteca JS que é usada para a criação de aplicações web de forma performática e simples.",
            image: "react.svg"
        },
        {
            title: "PHP",
            text: "A linguagem mais usada da Web! O PHP é uma linguagem interpretada que renderiza o site e a API do lado do servidor e está em mais de 60% dos sites atuais (inclusive esse)!",
            image: "php.png"
        },
        {
            title: "Flutter",
            text: "Flutter é um framework da linguagem Dart que foi feito para criação de aplicativos multiplataforma",
            image: "flutter.png"
        },
        {
            title: "GIT",
            text: "É a ferramenta de versionamento de código usada para gerenciar as versões das aplicações e também registrar as alterações e histórico do código da aplicação.",
            image: "git.png"
        },
        {
            title: "HTML",
            text: "HTML é a linguagem de marcações que cria os itens visuais de um site. Se você esta lendo isso nesse site, é por causa do HTML.",
            image: "html.svg"
        },
        {
            title: "CSS",
            text: "CSS é uma linguagem de estilização que é usada para dar beleza aos sites e aplicativos que utilizem as marcações HTML.",
            image: "css.svg"
        },
    ];

    var skillCardList = document.getElementById("skillCardList");

    for (const i in cards) {
        const card = cards[i];
        console.log(i <= 3 ? "top" : "bottom");

        var divCol3 = document.createElement("div");
        divCol3.setAttribute("class", "col-md-3");

        var divCard = document.createElement("div");
        divCard.setAttribute("class", "card");
        divCard.setAttribute("data-bs-toggle", "tooltip");
        divCard.setAttribute("data-bs-placement", i <= 3 ? "top" : "bottom");
        divCard.setAttribute("title", card.title);

        divCol3.appendChild(divCard);

        var divCardBody = document.createElement("div");
        divCardBody.setAttribute("class", "card-body");

        divCard.appendChild(divCardBody);

        var image = document.createElement("img");
        image.setAttribute("src", `/public/assets/images/${card.image}`);

        divCardBody.appendChild(image);

        divCol3.addEventListener("mouseover", () => {
            document.getElementById("textoSkill").innerText = card.text;
        });

        divCol3.addEventListener("mouseleave", () => {
            document.getElementById("textoSkill").innerText = "Passe o mouse ao lado para ver mais informações";
        });


        skillCardList.appendChild(divCol3);
    }




    // skillCardList

    // var skillCards = [].slice.call(document.querySelectorAll('.skillCard'));
    // skillCards.map((card) => {

    // });
}

document.addEventListener("DOMContentLoaded", function() { // On DOM Load initiate the effect
    if (textArray.length) setTimeout(type, newTextDelay + 250);

    SetSkillCardsText();
    SetToolTips();



});
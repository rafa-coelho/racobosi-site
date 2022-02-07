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
        var divCol3 = document.createElement("div");
        divCol3.setAttribute("class", "col-4 col-md-3");

        var divCard = document.createElement("div");
        divCard.setAttribute("class", "card");
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

function SetProjectsCards() {
    const projetos = [{
            title: "Fichas de RPG",
            description: "Sistema de gerenciamento de Fichas de RPG focado no Dungeons and Dragons",
            url: "https://github.com/rafa-coelho/SistemaFichas",
            stack: "React JS"
        },
        {
            title: "Site de Casamento",
            description: "Sistema que eu usei para o meu site de casamento com lista de compras, pagamento online e confirmação de presença!",
            url: "https://github.com/rafa-coelho/site-casamento",
            stack: "React JS"
        },
        {
            title: "Feature Toggle",
            description: "Aplicação usada para gerenciar funcionalidades em ambientes diferentes para poder ligar ou desligá-las quando quiser.",
            url: "https://github.com/rafa-coelho/feature-toggle-api",
            stack: "NodeJS (Typescript)"
        },
        {
            title: "Client da API do Pagseguro",
            description: "Pacote NPM para consumir a API de pagamento transparente do PagSeguro",
            url: "https://www.npmjs.com/package/pagseguro-api",
            stack: "NodeJS"
        },
    ];

    let html = '';
    for (const projeto of projetos) {
        html += `<div class="col-md-3 mb-3 d-flex align-items-stretch">`;
        html += `    <div class="card p-2">`;
        html += `        <div class="card-body">`;
        html += `            <h5 class="card-title"> <a target="blank" href="${projeto.url}">${projeto.title}</a></h5>`;
        html += `            <h6 class="card-subtitle mb-2 text-muted">${projeto.stack}</h6>`;
        html += `            <p class="card-text pt-3">`;
        html += `                ${projeto.description}`;
        html += `            </p>`;
        html += `        </div>`;
        html += `        <div class="card-footer">`;
        html += `            <a target="blank" href="${projeto.url}">Ver mais</a>`;
        html += `        </div>`;
        html += `    </div>`;
        html += `</div>`;
    }

    document.getElementById("projetosRealizados").innerHTML = html;
}

function SetClientsCards() {

    const clientes = [{
            title: "Prefácio",
            subtitle: "Portal de Controle de Vendas",
            stack: "ReactJS e NodeJS",
            company: "A Prefácio é uma empresa de confecção e venda de paramentos religiosos.",
            project: "Foi criado um sistema de gerenciamento de Pedidos e Clientes com gerenciamento de produção, estoque e com controle de acessos por níveis.",
            image: "prefacio.png"
        },
        {
            title: "Club7",
            subtitle: "Plataforma, Aplicativo e Aplicação BackOffice",
            stack: "NextJS, NodeJS e Flutter",
            company: "Club7 é uma plataforma onde estabelecimentos e motoristas de aplicativo se encontram.",
            project: "Foi criado o sistema de mapeamento, o Portal para estabelecimentos e o Aplicativo para os motoristas, contando com um sistema de cobrança recorrente de assinatura do serviço e uma aplicação de gerenciamento de clientes.",
            image: "club7.png"
        },
        {
            title: "LeadThis",
            subtitle: "Plataforma de Geração e Venda de Leads",
            stack: "NodeJS e ReactJS",
            company: "O LeadThis era uma plataforma onde os corretores de planos de saúde podiam encontrar clientes em potencial.",
            project: "Foi criado o sistema de captura de Leads e a Plataforma onde o Corretor podia comprar a Lead que mais lhe interessasse.",
            image: "leadthis.png"
        },
    ];

    let html = '';
    for (const cliente of clientes) {
        html += `<div class="col-xs-12 col-sm-12 col-md-4 d-flex align-items-stretch mb-3">`;
        html += `    <div class="card">`;
        html += `        <div class="card-body text-center">`;
        html += `            <img src="/public/assets/images/${cliente.image}" class="rounded mx-auto d-block" alt="${cliente.title}">`;
        html += `            <h5 class="card-title">${cliente.title}</h5>`;
        html += `            <h6 class="card-subtitle text-muted pt-2">${cliente.subtitle}</h6>`;
        html += `            <h6 class="card-subtitle text-muted pt-2">${cliente.stack}</h6>`;
        html += `            <p class="card-text pt-3 ">`;
        html += `                ${cliente.company}`;
        html += `            </p>`;
        html += `            <b>O que foi feito</b>`;
        html += `            <p class="card-text pt-2">`;
        html += `                ${cliente.project}`;
        html += `            </p>`;
        html += `        </div>`;
        html += `    </div>`;
        html += `</div>`;
    }

    document.getElementById("clientesAtendidos").innerHTML = html;
}

document.addEventListener("DOMContentLoaded", function() { // On DOM Load initiate the effect
    if (textArray.length) setTimeout(type, newTextDelay + 250);

    SetSkillCardsText();
    SetProjectsCards();
    SetClientsCards();
});
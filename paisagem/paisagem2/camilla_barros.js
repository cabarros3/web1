/*
 * a ideia é fazer com que um carro se movimente na tela para frente e para trás com as teclas de seta e pule com a tecla de espaço, além de mudar de cor com cliques no corpo do carro.
 * bônus: ao clicar no sol uma nave alienígena aparece e some da tela com efeito sonoro.
 */

const carro = document.querySelector(".carro");
const corpo = carro.querySelector(".corpo");
const sol = document.querySelector(".sol");

// para definir pulo, posição, velociadade e limite da tela para o carro
let pulando = false;
let posX = 100;
const velocidade = 15;
const limiteEsq = 0;
const limiteDir = window.innerWidth - 120;

// para contar a quantidade de clique, definir cores, limite de cliques e estado do corpo do carro que receberá a mudança de cores
let cliques = 0;
const cores = ["red", "blue", "yellow", "purple", "pink", "orange"];
const limiteArcoIris = 5;
let arcoIrisAtivo = false; // novo estado

/* 
 - Adiciona evento para criar movimento e salto
 - se o código do evento do teclado for "espaço" e a var pulando estiver falsa, muda para true, adiciona a classe salto. No mesmo momento remove a classe salto e a var pulando volta para false
 - No evento de teclado identifica os eventos das setas para determinar velocidade e posição.
*/
document.addEventListener("keydown", (event) => {
  if (event.code === "Space" && !pulando) {
    pulando = true;
    carro.classList.add("salto");
    carro.addEventListener(
      "animationend",
      () => {
        carro.classList.remove("salto");
        pulando = false;
      },
      { once: true }
    );
  }

  if (event.code === "ArrowRight") {
    posX += velocidade;
    if (posX > limiteDir) posX = limiteDir;
  }

  if (event.code === "ArrowLeft") {
    posX -= velocidade;
    if (posX < limiteEsq) posX = limiteEsq;
  }

  carro.style.left = posX + "px";
});

// clique: muda cor e ativa/desativa arco-íris
carro.addEventListener("click", () => {
  if (arcoIrisAtivo) {
    // Se o arco-íris estiver ativo, desativa e volta a cor original
    corpo.classList.remove("arcobaleno");
    corpo.style.backgroundColor = "red";
    arcoIrisAtivo = false;
    cliques = 0; // reinicia contador
    return;
  }

  cliques++;

  if (cliques < limiteArcoIris) {
    const novaCor = cores[cliques % cores.length];
    corpo.style.backgroundColor = novaCor;
  } else {
    corpo.classList.add("arcobaleno");
    arcoIrisAtivo = true;
  }
});

// evento de clique no sol para criar bolhas de sabão
sol.addEventListener("click", () => {
  aparecerNave();
});

function aparecerNave() {
  // cria o elemento da nave
  const nave = document.createElement("div");
  nave.classList.add("nave");

  // posição inicial: vindo da esquerda, altura próxima do sol
  const solRect = sol.getBoundingClientRect();
  nave.style.top = `${solRect.top + 20}px`;
  nave.style.left = `-150px`;

  document.body.appendChild(nave);

  // toca o som da nave
  const somNave = new Audio("./camilla_barros_nave.mp3");
  somNave.volume = 0.3; // ajuste do volume (0.0 a 1.0)
  somNave.play();

  // aplica a animação de voo
  nave.style.animation = "vooNave 5s ease-in-out forwards";

  // remove após o voo
  setTimeout(() => {
    nave.remove();
  }, 5000);
}

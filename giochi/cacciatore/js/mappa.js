// omino
var ominoX = 0;
var ominoY = 0;
var ominoBloccato = false;

//pillole ostacoli e funghi
var numPillole = 150;
var numOstacoli = 20;
var numFunghi = 30;


// valore iniziale dell'energia
var energia = 0;
var stato;

//clessidra
var wMax = 600;
var w = wMax;
var timer;
var winValue = 149;
// costanti e parametri per la configurazioen del gioco
var PILLOLA = 1;
var DELTA_ENERGIA = 1;
var FUNGO_MENO = 10;
var OSTACOLO = 3;
var SFONDO = 0;
var FUNGO = 5;

var omino = "omino";
var sato;
var contFunghi;

var pathImg = "img1/";
var DISTANZA = 4;
// dichiarazione variabili di lavoro
var i = 0;
var j = 0;
var countPillole = 0;

// numero di righe e numero di colonne
var R = 10;
var C = 20;
//cacciatore
var cacciatoreId = null;
var celleAttraversate = [];

// definizione id matrice, come array di array
var piano = new Array();

for (var i = 0; i < R; i++) {
  piano[i] = new Array();
  for (var j = 0; j < C; j++) {
    piano[i][j] = SFONDO; // si assegna un valore di default a tutte le celle
  }
}
piano[5][6] = FUNGO;
// posizionamento di un ostacolo per esempio

function mostraMatriceHTML() {
  var s = "";

  for (var i = 0; i < R; i++) {
    for (var j = 0; j < C; j++) {
      s = s + piano[i][j] + " ";
    }
    s = s + "<br>";
  }
  document.getElementById("messaggioDebug").innerHTML = s;
}

function disegnaPiano() {
  for (var i = 0; i < R; i++) {
    for (var j = 0; j < C; j++) {
      disegnaCella(i, j);
    }
  }
  // disegna l'omino in una data posizione
  disegnaCellaSpeciale(ominoX, ominoY, stato, ".png");
}

function generaOstacolo() {
  generaOggetto(OSTACOLO);
}

function generaPillole() {
  for (var i = 0; i < R; i++) {
    for (var j = 0; j < C; j++) {
      if (piano[i][j] !== OSTACOLO && piano[i][j] !== FUNGO) {
        piano[i][j] = PILLOLA;
        disegnaCella(i, j);
      }
    }
  }
}

function disegnaCella(i, j) {
  var id = "c" + i + "_" + j;
  var src = pathImg + piano[i][j] + ".jpg";
  document.getElementById(id).src = src;
}

function disegnaCellaSpeciale(i, j, valore, x) {
  var id = "c" + i + "_" + j;
  var src = pathImg + valore + x;
  console.log(id + " " + src);
  document.getElementById(id).src = src;
}

function disegnaOmino() {
  disegnaCellaSpeciale(ominoX, ominoY, stato, ".png");
  document.getElementById("posizioneOmino").innerHTML =
    " coordinate omino: Omino(" + ominoX + "," + ominoY + ")";
}

function generaOstacolo() {
  var x = Math.floor(Math.random() * R);
  var y = Math.floor(Math.random() * C);
  if (piano[x][y] !== OSTACOLO && piano[x][y] !== FUNGO) {
    piano[x][y] = OSTACOLO;
    disegnaCellaSpeciale(x, y, OSTACOLO, ".jpg");
  } else {
    generaOstacolo(); // Se la cella scelta casualmente contiene già un ostacolo o un fungo, riprova
  }
}

function generaFungo() {
  var x = Math.floor(Math.random() * R);
  var y = Math.floor(Math.random() * C);
  if (piano[x][y] !== OSTACOLO && piano[x][y] !== FUNGO) {
    piano[x][y] = FUNGO;
    disegnaCellaSpeciale(x, y, FUNGO, ".jpg");
  } else {
    generaFungo(); // Se la cella scelta casualmente contiene già un ostacolo o un fungo, riprova
  }
}

function inizializza() {
  for (var i = 0; i < R; i++) {
    for (var j = 0; j < C; j++) {
      if (piano[i][j] === OSTACOLO) {
        disegnaCellaSpeciale(i, j, OSTACOLO, ".jpg");
      } else if (piano[i][j] === FUNGO) {
        disegnaCellaSpeciale(i, j, FUNGO, ".jpg");
      } else {
        var randomNumber = Math.random();
        if (randomNumber < 0.1 && numOstacoli > 0) {
          generaOstacolo();
          numOstacoli--;
        } else if (randomNumber < 0.3 && numFunghi > 0) {
          generaFungo();
          numFunghi--;
        } else {
          generaPillole();
        }
      }
    }
  }
  disegnaOmino();
  disegnaPiano();
  music();
}

async function replay() {
  // Fai il refresh della pagina
  let dati = await restart();
  post("http://localhost/kingame/MultiplayerSystem/CreaStanza.php",dati);
}

function clessidra() {
  //console.log("w="+w);

  w = w - 1;

  document.getElementById("barra_tempo").style.width = w + "px";
  if (w == 0) {
    gameOver(null);
  } else if (w <= wMax / 5) {
    document.getElementById("barra_tempo").style.backgroundColor = "red";
  } else if (w <= wMax / 3) {
    document.getElementById("barra_tempo").style.backgroundColor = "orange";
  } else if (w <= wMax / 2) {
    document.getElementById("barra_tempo").style.backgroundColor = "yellow";
  }
}
timer = setInterval("clessidra()", 300);

function win() {
  energia = Math.floor(energia*1.5);
  
  document.getElementById("energia").innerHTML = energia;
  document.getElementById("text").innerHTML = "HAI VINTO";
  finito();
  winMusic();
  ominoBloccato = true;
  endGame();
}

function finito() {
  clearInterval(timer);
}

var audio = document.createElement("audio");
var isFirstClick = true;

function handleKeyPress(event) {
  if (isFirstClick) {
    music(); // Avvia la riproduzione della musica solo al primo click
    isFirstClick = false; // Imposta isFirstClick a false dopo il primo click
  }
}

document.addEventListener("keydown", handleKeyPress);

function music() {
  audio.setAttribute("src", "music.mp3");
  enableLoop();
  audio.play();
}

function enableLoop() {
  audio.loop = false; // Disabilita il loop predefinito
  audio.addEventListener("ended", function () {
    audio.currentTime = 0; // Resetta il tempo di riproduzione al punto iniziale
    audio.play(); // Avvia nuovamente la riproduzione
  });
}

function gOverMusic() {
  audio.setAttribute("src", "over.mp3");
  audio.play();
}

function winMusic() {
  audio.setAttribute("src", "win.mp3");
  audio.play();
}

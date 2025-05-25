var stato = "ominoGu";
//gestione dell'evento onkeydown:
function checkKeyDown(e) {
  e = e || window.event;
  switch (e.keyCode) {
    case 39:
      destra();
      break;
    case 40:
      giu();
      break;
    case 37:
      sinistra();
      break;
    case 38:
      su();
      break;
  }
  //alert ("The Unicode character code is: " + e.keyCode);
}

// gestione dell'evento onkey press:
function checkKeyPress(event) {
  var chCode = "charCode" in event ? event.charCode : event.keyCode;

  switch (chCode) {
    case 100:
      destra();
      break;
    case 115:
      giu();
      break;
    case 97:
      sinistra();
      break;
    case 119:
      su();
      break;
  }
  //alert ("The Unicode character code is: " + chCode);
}

function controllaCella(x, y) {
  if (ominoBloccato) {
    return false; // Se l'omino è bloccato, non permettere lo spostamento
  }
  switch (piano[x][y]) {
    case OSTACOLO:
      return false;
    case PILLOLA:
      energia = energia + DELTA_ENERGIA;
      document.getElementById("energia").innerHTML = energia;
      piano[x][y] = SFONDO;
      countPillole--;
      if (energia == winValue) {
        document.getElementById("energia").innerHTML = '<img src="coppa.jpg" >';
        win();
      }
      return true;
    case FUNGO:
      contFunghi++;
      piano[x][y] = SFONDO;

      if (contFunghi > 2) {
        gameOver();
        inizializza();
      } else {
        // Blocca l'omino per 3 secondi quando tocca un fungo
        ominoBloccato = true;
        setTimeout(function () {
          ominoBloccato = false;
        }, 3000);
      }

      return true;
    default:
      return true;
  }
}

function gameOver(cause) {
  if (cause === "cacciatore" || w == 0) {
    ominoBloccato = true;
    gOverMusic();
  }
  document.getElementById("text").innerHTML = "GAME OVER";
  endGame();
}

function incrementaEnergia() {
  energia += DELTA_ENERGIA;
  document.getElementById("energia").innerHTML = energia;
}

function sposta(daX, daY, aX, aY) {
  if (controllaCella(aX, aY)) {
    var daSrc = "c" + daX + "_" + daY;
    var aSrc = "c" + aX + "_" + aY;
    console.log(daSrc + " " + aSrc);
    document.getElementById(daSrc).src = pathImg + SFONDO + ".jpg";
    ominoX = aX;
    ominoY = aY;
    disegnaOmino();
  }
}

function su() {
  stato = "ominoSu";
  var newX = (ominoX - 1 + R) % R;
  sposta(ominoX, ominoY, newX, ominoY);
}

function sinistra() {
  stato = "ominoSi";
  var newY = (ominoY - 1 + C) % C;
  sposta(ominoX, ominoY, ominoX, newY);
}

function giu() {
  stato = "ominoGu";
  var newX = (ominoX + 1 + R) % R;
  sposta(ominoX, ominoY, newX, ominoY);
}

function destra() {
  stato = "ominoDe";
  var newY = (ominoY + 1 + C) % C;
  sposta(ominoX, ominoY, ominoX, newY);
}
function calcolaDistanza(x1, y1, x2, y2) {
  const dx = x2 - x1;
  const dy = y2 - y1;
  return Math.sqrt(dx * dx + dy * dy);
}

function Cacciatore() {
  do{
    var [x,y] = generaPosizione();
    var distanza = calcolaDistanza(ominoX,ominoY,x,y);
  }while(distanza<DISTANZA);
  this.x = x;
  this.y = y;
}
Cacciatore.prototype.muovi = function () {
    // Ripristina la vecchia cella del cacciatore

  var nuovaPosizione = this.calcolaNuovaPosizione();

  if (
    piano[nuovaPosizione.x][nuovaPosizione.y] !== OSTACOLO &&
    piano[nuovaPosizione.x][nuovaPosizione.y] !== FUNGO
  ) {

    document.getElementById("c" + this.x + "_" + this.y).src =
      pathImg + piano[this.x][this.y] + ".jpg";
    this.x = nuovaPosizione.x;
    this.y = nuovaPosizione.y;
    this.disegna();

    // Controllo se il cacciatore ha catturato l'omino
    if (this.x === ominoX && this.y === ominoY) {
      gameOver("cacciatore");
      return;
    }
  }
};
Cacciatore.prototype.disegna = function () {
    // Disegna il cacciatore nella nuova posizione
    document.getElementById("c" + this.x + "_" + this.y).src =
      pathImg + "cacciatore.jpg";
};

Cacciatore.prototype.calcolaNuovaPosizione = function () {
  var deltaX = ominoX - this.x;
  var deltaY = ominoY - this.y;

  var nuovaX = this.x;
  var nuovaY = this.y;

  // si spostata solo lungo l'asse X o Y, non in obliquo
  if (Math.abs(deltaX) > Math.abs(deltaY)) {
    // Se la distanza lungo X è maggiore, spostati lungo X
    if (deltaX > 0 && nuovaX < R - 1) {
      nuovaX++;
    } else if (deltaX < 0 && nuovaX > 0) {
      nuovaX--;
    }
  } else {
    // Altrimenti, spostati lungo Y
    if (deltaY > 0 && nuovaY < C - 1) {
      nuovaY++;
    } else if (deltaY < 0 && nuovaY > 0) {
      nuovaY--;
    }
  }

  return { x: nuovaX, y: nuovaY };
};

var cacciatore;
var cacciatoreMovimento;
function initCacciatore() {
  cacciatore = new Cacciatore();
  
  console.log(cacciatore.calcolaNuovaPosizione());
  cacciatore.muovi();
  cacciatore.disegna();
  cacciatoreMovimento = setInterval("cacciatore.muovi()", 500); //500
}

function generaPosizione(){
  do{
    var x = Math.floor(Math.random() * R);
    var y = Math.floor(Math.random() * C);
  }while(piano[x][y] != 1 && piano[x][y] != 0);
  return [x,y];
}

function endGame(){
  document.getElementById("replayButton").style.display = "block";
  clearInterval(cacciatoreMovimento);
  clearInterval(timer);
  let params = {
      score: energia
  };
  fetch("http://" + host + "/kingame/giochi/updateScore.php", {
      method: 'POST', // Specify the HTTP method
      headers: {
          'Content-Type': 'application/json', // Tell the server that you're sending JSON
      },
      body: JSON.stringify(params), // Convert the JavaScript object to a JSON string
  });
}

function post(path, params, method='post') {

    const form = document.createElement('form');
    form.method = method;
    form.action = path;
  
    for (const key in params) {
      if (params.hasOwnProperty(key)) {
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = key;
        hiddenField.value = params[key];
  
        form.appendChild(hiddenField);
      }
    }
  
    document.body.appendChild(form);
    form.submit();
}

async function restart() {
    try {
        const response = await fetch("http://" + host + "/kingame/giochi/restart.php");

        // Leggi la risposta come testo (non JSON, per ora)
        const text = await response.text(); // ricevi la risposta come testo
        console.log("Risposta grezza:", text); // logga la risposta

        // Se la risposta è corretta e JSON, parsala
        const risposta = JSON.parse(text);
        return risposta;

    } catch (error) {
        console.error("Errore durante il fetch:", error);
        return null;
    }
}
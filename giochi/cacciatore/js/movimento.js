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
      if (energia == 1400) {
        document.getElementById("energia").innerHTML = '<img src="coppa.jpg" >';
        win();
      }
      return true;
    case FUNGO:
      contFunghi++;
      piano[x][y] = SFONDO;

      if (contFunghi > 2) {
        gameover();
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

function gameover(cause) {
  if (
    cause === "cacciatore" &&
    document.getElementById("energia").innerHTML !== "Game Over"
  ) {
    document.getElementById("energia").innerHTML = "Game Over";
    document.getElementById("replayButton").style.display = "block";
    ominoBloccato = true;
    gOverMusic();
    setTimeout(function () {}, 0);
  }
}

function gameOver() {
  if (w == 0 && document.getElementById("energia").innerHTML !== "GameOver") {
    document.getElementById("energia").innerHTML = "GameOver";
    document.getElementById("replayButton").style.display = "BLOCK";
    ominoBloccato = true;
    gOverMusic();
    setTimeout(function () {}, 0);
  }
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

function Cacciatore(x, y) {
  this.x = x;
  this.y = y;
}
Cacciatore.prototype.muovi = function () {
  if (ominoBloccato) {
    return; // Se l'omino è bloccato, non muovere il cacciatore
  }

  var nuovaPosizione = this.calcolaNuovaPosizione();

  if (
    piano[nuovaPosizione.x][nuovaPosizione.y] !== OSTACOLO &&
    piano[nuovaPosizione.x][nuovaPosizione.y] !== FUNGO
  ) {
    // Ripristina la vecchia cella del cacciatore
    document.getElementById("c" + this.x + "_" + this.y).src =
      pathImg + piano[this.x][this.y] + ".jpg";

    this.x = nuovaPosizione.x;
    this.y = nuovaPosizione.y;

    // Disegna il cacciatore nella nuova posizione
    document.getElementById("c" + this.x + "_" + this.y).src =
      pathImg + "cacciatore.jpg";

    // Controllo se il cacciatore ha catturato l'omino
    if (this.x === ominoX && this.y === ominoY) {
      gameover("cacciatore");
      return;
    }
  }
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
function initCacciatore() {
  cacciatore = new Cacciatore(cacciatoreX, cacciatoreY);

  console.log(cacciatore.calcolaNuovaPosizione());
  cacciatore.muovi();
  setInterval("cacciatore.muovi()", 500); //500
}

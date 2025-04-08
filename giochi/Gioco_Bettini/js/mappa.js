// posizione iniziale dell'omino
var ominoX = Math.floor(Math.random() * 10) ; 
var ominoY = Math.floor(Math.random() * 10);

//posizione iniziale cacciatore
var cacciatoreX = Math.floor(Math.random() * 10) ;
var cacciatoreY = Math.floor(Math.random() * 10) ;

// posizione dell'arma
var armaX = 9; 
var armaY = 9;

// valore iniziale dell'energia
var energia =0;

// costanti e parametri per la configurazioen del gioco
var PILLOLA = 1;
var DELTA_ENERGIA = 20;
var OSTACOLO=3; 
var SFONDO = 8;
var scherma=2;
var FUNGO = 7;

var omino = "omino";
var arma = "scherma";

var pathImg = "img1/";

// dichiarazione variabili di lavoro
var i=0;
var j=0;
var countPillole = 0;

// numero di righe e numero di colonne
var R = 10; 
var C = 20; 

// definizione id matrice, come array di array
var piano = new Array();

for (var i=0; i<R; i++) {
	piano[i]=new Array(); // ogni riga contiene un array: si ha così una matrice
	for (var j=0; j<C;j++){
		piano[i][j]=SFONDO; // si assegna un valore di default a tutte le celle
	}
}

// posizionamento di un ostacolo per esempio

piano[armaX][armaY] = arma;

function generaPillole(){
    countPillole ++; //vanno raccolti tutti, meglio contarli
	generaOggetto(PILLOLA);
}

function generaOstacolo(){
	generaOggetto(OSTACOLO);
}

function generaOggetto(valOggetto){
	// si genera un indice di riga casuale tra 0 e R
	var r = Math.random(); 
	rx = Math.round( r * R);
	// si genera un indice di colonna casuale tra 0 e C
	var c = Math.random(); 
	ry = Math.round( c * C);
	// utilizzando rx e rc si ha una posizione casuale nel piano di gioco
	if (piano[rx][ry]>0) {
		alert("c'e' gia qualcosa!!"); 
	}
	piano[rx][ry] = valOggetto; //posiziona oggetto nella matrice
	// in rx, ry c'è un nuovo valore quindi meglio ridisegnare la cella
	disegnaCella(rx,ry);
	
	
}

function disegnaCella(i,j){
	var id = "c"+i+"_"+j;
	var src = pathImg + piano[i][j] + ".jpg";
	document.getElementById(id).src= src;
} 

function disegnaCellaSpeciale(i,j,valore) {
	var id = "c"+i+"_"+j;
	var src = pathImg + valore + ".jpg";
	console.log(id + " " + src);
	document.getElementById(id).src=src;
	
} 

function disegnaOmino() {
	disegnaCellaSpeciale(ominoX,ominoY,omino);
	document.getElementById("posizioneOmino").innerHTML=" coordinate omino: Omino(" + ominoX + "," + ominoY + ")"; 
}

function calcolaNuovaPosizioneCacciatore(){
	var randomDirection = Math.floor(Math.random() * 4);
	var nuovaX = cacciatoreX;
	var nuovaY = cacciatoreY;
	
	switch(randomDirection){
		case 0:
			if(nuovaX > 0) nuovaX--;
			break;
		case 1:
			if(nuovaX < R - 1) nuovaX++;
			break;
		case 2:
			if (nuovaY > 0) nuovaY--;
			break;
		case 3:
			if (nuovaY < C - 1) nuovaY++;
			break;
	}
	
	return { x: nuovaX, y: nuovaY };
	
}

function disegnaCacciatore() {
	var deltaX = ominoX - cacciatoreX;
	var deltaY = ominoY - cacciatoreY;
	
	var nuovaX = cacciatoreX;
	var nuovaY = cacciatoreY;
	
	if(Math.abs(deltaX) > Math.abs(deltaY)){
		nuovaX = deltaX > 0 ? cacciatoreX + 1 : cacciatoreX - 1;
	} else{
		nuovaY = deltaY > 0 ? cacciatoreY + 1 : cacciatoreY - 1;
	}
	
	if(piano[nuovaX][nuovaY] !== OSTACOLO && piano[nuovaX][nuovaY] !== FUNGO) {
		document.getElementById("c" + cacciatoreX + "_" + cacciatoreY).src = pathImg + piano[cacciatoreX][cacciatoreY] + ".jpg";
		
		cacciatoreX = nuovaX;
		cacciatoreY = nuovaY;
		
		document.getElementById("c" + cacciatoreX + "_" + cacciatoreY).src = pathImg + "cacciatore.jpg";
		
	}
	
	if(cacciatoreX === ominoX && cacciatoreY === ominoY){
		gameOver();
		return;
	}
}

setInterval(disegnaCacciatore, 500);

/*function disegnaSecondoCacciatore() {
	var deltaX = ominoX - secondoCacciatoreX;
	var deltaY = ominoY - secondoCacciatoreY;
	
	var nuovaX = secondoCacciatoreX;
	var nuovaY = secondoCacciatoreY;
	
	if(Math.abs(deltaX) > Math.abs(deltaY)){
		nuovaX = deltaX > 0 ? secondoCacciatoreX + 1 : secondoCacciatoreX - 1;
	} else{
		nuovaY = deltaY > 0 ? secondoCacciatoreY + 1 : secondoCacciatoreY - 1;
	}
	
	if(piano[nuovaX][nuovaY] !== OSTACOLO && piano[nuovaX][nuovaY] !== FUNGO) {
		document.getElementById("c" + secondoCacciatoreX + "_" + secondoCacciatoreY).src = pathImg + piano[secondoCacciatoreX][secondoCacciatoreY] + ".jpg";
		
		secondoCacciatoreX = nuovaX;
		secondoCacciatoreY = nuovaY;
		
		document.getElementById("c" + secondoCacciatoreX + "_" + secondoCacciatoreY).src = pathImg + "secondoCacciatore.jpg";
		
	}
	
	if(secondoCacciatoreX === ominoX && secondoCacciatoreY === ominoY){
		gameOver();
		return;
	}
}

setInterval(disegnaSecondoCacciatore, 210);*/


function gameOver(){
	alert("HAI PERSO, TI SEI FATTO PRENDERE!!!");
	alert("SACCO DI PATATE, ORA DEVI RIPROVARE TUTTO DA CAPO");
	location.reload();
}

function startTimer(duration, display) {
    var start = Date.now(),
        diff,
        minutes,
        seconds;
    function timer() {
        diff = duration - (((Date.now() - start) / 1000) | 0);

        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds; 

        if (diff <= 0) {
            start = Date.now() + 1000;
			gameOver();
        }
    };
    timer();
    setInterval(timer, 1000);
}

window.onload = function () {
    var seconds = 6 * 5,
    display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};

function haiVinto(){
	alert("HAI VINTO!! SEI RIUSCITO A SCAPPARE DA FREDDY!!!");
}
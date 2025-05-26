var piano = new Array();

var pianoV = new Array();
var gameEnded = false;
var statoCelle=[];
var waitAdversary;

var username;
var stanza;
var staGiocando;

for(let i = 0; i < 9; i++){
    piano[i] = new Array();
    pianoV[i] = 0;
    statoCelle[i] = {
        canMove: true
    }
    for(let j = 0; j < 9; j++){
        piano[i][j] = 0;
    }
}

var giocatore = true;

var vittoria = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6]
]

function checkVittoria(piano){
    console.log("piano:",piano);
    for(let i = 0; i < vittoria.length; i++){
        if(piano[vittoria[i][0]] == piano[vittoria[i][1]] && piano[vittoria[i][1]] == piano[vittoria[i][2]] && piano[vittoria[i][1]] != 0){
            console.log([piano[vittoria[i][0]],piano[vittoria[i][1]],piano[vittoria[i][2]]])
            return vittoria[i];
        }
    }
    return false;
}

document.addEventListener("DOMContentLoaded", function(event) {
    init();
})
function init(){
    username = document.getElementById("username").value;
    document.getElementById("username").remove();
    stanza = document.getElementById("stanza").value;
    document.getElementById("stanza").remove();
    staGiocando = (document.getElementById("inizia").value == true);
    console.log(document.getElementById("inizia").value);
    document.getElementById("inizia").remove();
    console.log(staGiocando);
    if(staGiocando)
        setClickPiano(statoCelle);
    else{
        waitAdversary = setInterval(()=>{
            console.log(piano);
            handleAdversaryMove()}
        ,3000);
    }
    cambiaGiocatore()
}

function cellClickHandler(x, y) {
    console.log("game ended:",gameEnded);
    if (gameEnded) return;
    return function () {
        selectCell(x, y);
    };
}

const cellListeners = {}; // store listeners for later removal

function setClickPiano(trisPiano) {
    console.log("game ended:",gameEnded);
    if (gameEnded) return;
    console.log(trisPiano);
    for (let x = 0; x < 9; x++) {
        if(trisPiano[x].canMove)
            for (let y = 0; y<9; y++) {
                if (piano[x][y] === 0) {
                    let cell = document.getElementById(x + "-" + y);
                    const handler = cellClickHandler(x, y);
                    cellListeners[`${x}-${y}`] = handler;
                    cell.addEventListener("click", handler);
                }
            }
    }
}

function unsetClickPiano() {
    for (const [key, handler] of Object.entries(cellListeners)) {
        const cell = document.getElementById(key);
        if (cell) {
            cell.removeEventListener("click", handler);
        }
    }
}

async function getPiano() {
    const response = await fetch("http://"+host+"/kingame/giochi/tristris/getPiano.php?stanza="+stanza);
    const risposta = await response.json();
    let piano = [];
    for(let i = 0; i < 9; i++){
        piano[i] = new Array();
        for(let j = 0; j < 9; j++){
            piano[i][j] = 0;
        }
    }
    for (let i = 0; i < risposta.length; i++) {
        console.log(risposta);
        let cell = (risposta[i]["giocatore"] === username)? 1 : 2;

        piano[risposta[i]["x"]][risposta[i]["y"]] = cell;
    }
    return piano;
}

async function getUpdateCell() {
    const newPiano = await getPiano();
    console.log("newPiano", newPiano);
    for(const [x,value] of newPiano.entries()){
        for(const [y, cell] of value.entries()){
            console.log("update cell", cell);
            console.log("piano "+x+" "+y+":"+piano[x][y],piano[x][y] != cell);
            if(piano[x][y] != cell){
                console.log("piano "+x+" "+y,cell);
                return [x,y,cell];
            }
        }
    }
    return [false,false,false];
}

async function handleAdversaryMove(){
    let [x,y,cell] = await getUpdateCell();
    if(!cell){
        return false;
    }
    clearInterval(waitAdversary);
    piano[x][y] = cell;
    setStatoCell(x,y, false);
    giocatoreMove();
}

function setStatoCell(x, y, isPlayer){
    let stat = checkVittoria(piano[x]);
    if(Array.isArray(stat)||Array.isArray(checkVittoria(piano[y]))){
        pianoV[x] = piano[x][stat[0]];
        for(let [index,trisPiano] of piano.entries()){
            let cellaS = checkVittoria(trisPiano); 
            console.log(Array.isArray(cellaS),cellaS);
            if(Array.isArray(cellaS)){
                statoCelle[index] = {
                    canMove: false,
                    v: cellaS
                }
            }
            else{
                statoCelle[index] = {
                    canMove: true
                }
            }
            console.log(statoCelle);
        }
    }else{
        for(let [index,pianoTris] of piano.entries()){
            if(index == y){
                statoCelle[index] = {
                    canMove: true
                }
            }
            else{
                statoCelle[index] = {
                    canMove: false
                }
            }
        }
    }
    console.log("pianoV:",checkVittoria(pianoV));
    if(Array.isArray(checkVittoria(pianoV))){
        if(isPlayer) win()
        else lose();
        return;
    }
}

function giocatoreMove(){
    staGiocando = true;
    cambiaGiocatore();
    let movePiano = [];
    for(let [cell,index] of statoCelle.entries()){
        if(cell.canMove)
            movePiano.push(piano[i]);
    }
    setClickPiano(statoCelle);
    disegnaPiano();
}

function disegnaPiano(){
    for(let i=0; i<9; i++){
        let cellStat = statoCelle[i];
        let canSelect = cellStat.canMove;
        if(!canSelect){
            if(pianoV[i]!=0){
                if(pianoV[i]==1){
                    document.getElementById(i).classList.add("vittoria-player");
                }
                else if(pianoV[i]==2){
                    document.getElementById(i).classList.add("vittoria-adversary");
                }
                else{
                    document.getElementById(i).classList.add("nonSelezionato");
                }
            }
            else{
                document.getElementById(i).classList.add("nonSelezionato");
            }
        }
        else{
            if(document.getElementById(i).classList.contains("nonSelezionato"))
                document.getElementById(i).classList.remove("nonSelezionato");
        }
        for(let j=0; j<9; j++){
            let cell = piano[i][j];
            let htmlCell = document.getElementById(i+"-"+j);
            if(cell == 1){
                if(!htmlCell.classList.contains("player-select"))
                    htmlCell.classList.add("player-select");
            }
            if(cell == 2){
                if(!htmlCell.classList.contains("adversary-select")){
                        htmlCell.classList.add("adversary-select");
                        var svgNS = "http://www.w3.org/2000/svg";
                        var svg = document.createElementNS(svgNS, "svg");
                        svg.setAttribute("width", 32);
                        svg.setAttribute("height", 32);
                        htmlCell.appendChild(svg);

                        var circle = document.createElementNS(svgNS, "circle");
                        circle.setAttribute("cx", 16);
                        circle.setAttribute("cy", 16);
                        circle.setAttribute("r", 15);
                        circle.setAttribute("fill", "none");
                        circle.setAttribute("stroke", "#333");
                        circle.setAttribute("stroke-width", "2");
                        svg.appendChild(circle);

                    }
            }
        }
    }
    document.body.className = staGiocando? "player-turn" : "adversary-turn";
}

function selectCell(x,y){
    staGiocando = false;
    cambiaGiocatore();
    unsetClickPiano();
    piano[x][y] = 1;
    setStatoCell(x,y, true);
    disegnaPiano();
    let vittoria = checkVittoria(pianoV);
    if(Array.isArray(vittoria)){
        win();
    }
    updateCell(x,y);
    waitAdversary = setInterval(()=>{
        handleAdversaryMove()}
    ,3000);
}

function updateCell(x, y){
    let params = {
        stanza : stanza,
        x : x,
        y : y,
    }
    post(params,"http://"+host+"/Kingame/giochi/tristris/update.php");
}

function win(){
    let score = 700;
    gameOver(score,"you win");
}
function lose(){
    let score = 200;
    gameOver(score,"you lose");
}
async function gameOver(score,text){
    gameEnded = true;
    console.log("gameOver");
    unsetClickPiano();
    disegnaPiano();
    clearInterval(waitAdversary);

    const params = { score: score };
    try {
        const response = await fetch("http://"+host+"/kingame/giochi/updateScore.php", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(params)
        });
        
        const text = await response.text();
        console.log('Risposta grezza:', text);
        
    } catch (error) {
        console.error('Errore invio score:', error);
        return { success: false, error: error.message };
    }

    let gameoverText = document.getElementById("gameover-text");
    gameoverText.classList.remove("in-progress");
    gameoverText.innerHTML = text+"<br> score:"+score;
}

async function post(params,url){
    console.log(params,url);
    fetch(url, {
        method: 'POST', // Specify the HTTP method
        headers: {
            'Content-Type': 'application/json', // Tell the server that you're sending JSON
        },
        body: JSON.stringify(params), // Convert the JavaScript object to a JSON string
    })
    .then(result => {
        console.log('Success:', result); // Handle the response
    })
    .catch(error => {
        console.error('Error:', error); // Handle any errors
    });
}

function cambiaGiocatore(){
    var id = staGiocando? "playerBox" : "adversaryBox";
    var lastId = staGiocando? "adversaryBox" : "playerBox";
    document.getElementById(id).classList.add("expanded");
    document.getElementById(lastId).classList.remove("expanded");
}
var piano = new Array();

var pianoV = new Array();

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
    for(let i = 0; i < vittoria.length; i++){
        if(piano[vittoria[i][0]] == piano[vittoria[i][1]] && piano[vittoria[i][1]] == piano[vittoria[i][2]] && piano[vittoria[i][1]] != 0){
            return vittoria[i];
        }
    }
    return false;
}

/* 
function mossa(gPos, pPos){
    if(piano[gPos][pPos] === 0){
        if(giocatore){
            piano[gPos][pPos] = 1;
            document.getElementById(gPos+'-'+pPos).innerHTML = 'X';
        }
        else{
            piano[gPos][pPos] = 2;
            document.getElementById(gPos+'-'+pPos).innerHTML = 'O';
        }
        giocatore = !giocatore;
        var ris = checkVittoria(piano[gPos]);
        if(ris !== false){
            for(let i = 0; i < 3; i ++)
                document.getElementById(gPos+'-'+ris[i]).classList.add('vittoria');
            piano[gPos].splice(0,piano[gPos].length);
            if(giocatore){
                document.getElementById(gPos).classList.add('vittoriaG1');
                pianoV[gPos] = 1;
            }
            else{
                document.getElementById(gPos).classList.add('vittoriaG2');
                pianoV[gPos] = 2;
            }
        }

        if(piano[pPos].length !== 0){
            document.getElementById(pPos).classList.remove('nonSelezionato');
            for(let i = 0 ; i < 9; i++){
                if(i !== pPos)
                    document.getElementById(i).classList.add('nonSelezionato');
                for(let j = 0; j < 9; j ++){
                    if(i !== pPos){
                        document.getElementById(i+'-'+j).style.pointerEvents = 'none';
                    }
                    else{
                        document.getElementById(i+'-'+j).style.pointerEvents = 'auto';
                    }
                }
            }
        }
        else{
            var ris1 = checkVittoria(pianoV);
            if(ris1 == false){
                for(let i = 0 ; i < 9; i++){
                    if(piano[i].length === 0)
                        document.getElementById(i).classList.add('nonSelezionato');
                    else
                        document.getElementById(i).classList.remove('nonSelezionato');
                    for(let j = 0; j < 9; j ++){
                        if(piano[i].length === 0){
                            document.getElementById(i+'-'+j).style.pointerEvents = 'none';
                        }
                        else{
                            document.getElementById(i+'-'+j).style.pointerEvents = 'auto';
                        }
                    }
                }
            }
        }
        console.log(pianoV);
        var ris1 = checkVittoria(pianoV);
        if(ris1 != false){

            for(let i = 0 ; i < 9; i++){
                document.getElementById(i).classList.remove('nonSelezionato');
                for(let j = 0; j < 9; j ++)
                    document.getElementById(i+'-'+j).style.pointerEvents = 'none';
            }
            if(giocatore)
                alert('vittoria giocatore1');
            else
                alert('vittoria giocatore2');
        }  
    }
} */

document.addEventListener("DOMContentLoaded", function(event) {
    init();
})
function init(){
    username = document.getElementById("username").value;
    document.getElementById("username").remove();
    stanza = document.getElementById("stanza").value;
    document.getElementById("stanza").remove();
    staGiocando = (document.getElementById("inizia").value == true);
    document.getElementById("inizia").remove();
    if(staGiocando)
        setClickPiano(statoCelle);
}

function cellClickHandler(x, y) {
    return function () {
        selectCell(x, y);
    };
}

const cellListeners = {}; // store listeners for later removal

function setClickPiano(trisPiano) {
    console.log(trisPiano);
    for (let x = 0; x < 9; x++) {
        if(trisPiano[x].canMove)
            for (let y = 0; y<9; y++) {
                console.log(piano[x][y]);
                if (piano[x][y] === 0) {
                    let cell = document.getElementById(x + "-" + y);
                    const handler = cellClickHandler(x, y);
                    cellListeners[`${x}-${y}`] = handler;
                    cell.addEventListener("click", handler);
                    console.log(x + "-" + y);
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
    const response = await fetch("http://localhost/kingame/giochi/tristris/getPiano.php?stanza="+stanza);
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
    console.log("aaa",cell);
    console.log(!cell);
    if(!cell){
        return false;
    }
    clearInterval(waitAdversary);
    piano[x][y] = cell;
    setStatoCell(x,y, false);
    giocatoreMove();
}

function setStatoCell(x,y, isPlayer){
    let stat = checkVittoria(piano[x]);
    console.log(`${x}-${y}-${isPlayer}`,stat);

    if(stat){
        pianoV[x] = piano[x][stat[0]];
        if(checkVittoria(pianoV)){
            if(isPlayer) win()
            else lose();
            return;
        }
        for(let [trisPiano,index] of piano.entries()){
            let cellaS = checkVittoria(trisPiano); 
            if(!cellaS){
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
        console.log(statoCelle);
    }
}

function giocatoreMove(){
    staGiocando = true;
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
        console.log("statocell"+i,cellStat);
        let canSelect = cellStat.canMove;
        if(!canSelect){
            document.getElementById(i).classList.add("nonSelezionato");
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
                if(!htmlCell.classList.contains("adversary-select"))
                    htmlCell.classList.add("adversary-select");
            }
        }
    }
    document.body.className = staGiocando? "player-turn" : "adversary-turn";
}

function selectCell(x,y){
    staGiocando = false;
    unsetClickPiano();
    piano[x][y] = 1;
    setStatoCell(x,y, true);
    disegnaPiano();
    let vittoria = checkVittoria(pianoV);
    if(vittoria){
        win();
    }
    updateCell(x,y);
    waitAdversary = setInterval(()=>{
        console.log(piano);
        handleAdversaryMove()}
    ,3000);
}

function updateCell(x, y){
    let params = {
        stanza : stanza,
        x : x,
        y : y,
    }
    post(params,"http://localhost/Kingame/giochi/tristris/update.php");
}

function win(){
    gameOver();
}
function lose(){
    gameOver();
}
function gameOver(){
    clearInterval(waitAdversary);
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
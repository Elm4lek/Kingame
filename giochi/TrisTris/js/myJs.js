var piano = new Array();

var pianoV = new Array();

var username;
var stanza;
var staGiocando;

for(let i = 0; i < 9; i++){
    piano[i] = new Array();
    pianoV[i] = 0;
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
            console.log("80:"+ris1);
            console.log(pianoV);
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
})

function init(){
    username = document.getElementById("username").value;
    document.getElementById("username").remove();
    stanza = document.getElementById("stanza").value;
    document.getElementById("stanza").remove();
    staGiocando = (document.getElementById("inizia").value == true);
    document.getElementById("inizia").remove();
}

function cellClickHandler(x, y) {
    return function () {
        selectCell(x, y);
    };
}

const cellListeners = {}; // store listeners for later removal

function setClickPiano(trisPiano) {
    for (const [x, row] of trisPiano.entries()) {
        for (const [y, value] of row.entries()) {
            if (value === 0) {
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
    const response = await fetch("http://localhost/kingame/giochi/tristris/getPiano.php");
    const risposta = await response.json();
    let piano = [];
    for (let i = 0; i < risposta.length; i++) {
        let cell = (risposta[i]["giocatore"] === giocatore)? 1 : 2;
        piano[risposta[i]["x"]][risposta[i]["y"]] = cell;
    }
    return piano;
}

async function getUpdateCell() {
    const newPiano = await getPiano();
    for(const [x, value] of newPiano.entries()){
        for(const [y, cell] of value.entries()){
            if(piano[x][y] != cell){
                return cell;
            }
        }
    }
}

function giocatoreMove(x){
    staGiocando = true;
    disegnaPiano();
    setClickPiano(x);
}

function disegnaPiano(){
    for(let i=0; i<9; i++){
        for(let j=0; j<9; j++){
            let cell = piano[i][j];
            let htmlCell = document.getElementById(i+"-"+j);
            if(cell == 1){
                htmlCell.className = "cell player-select";
            }
            if(cell == 2){
                htmlCell.className = "cell adversary-select";
            }
        }
        let vittoria = checkVittoria(piano[x]);
        
        if(Array.isArray(vittoria)){
            for(let j of piano)
                document.getElementById(x+"-"+j).
        }
    }
    document.body.className = staGiocando? "player-turn" : "adversary-turn";
}

function selectCell(x,y){
    staGiocando = false;
    unsetClickPiano();
    let vittoria = checkVittoria(piano[x]);
    if(Array.isArray(vittoria)){
        document.getElementById(x);
    }
}
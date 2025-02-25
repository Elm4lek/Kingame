
function move(name, description, pp){
    var move = {};
    move.name = name;
    move.description = description;
    move.pp = pp;
    move.ppRest = pp;
    return move;
}
var pm = {
    name : "pilpup",
    hp : 100,
    atk : 50,
    movelist :[
        move("botta","shgdsda",1),
        move("negro","shgdsda",1),
        move("botta","shgdsda",1),
        move("botta","shgdsda",1)]
}

function select(choice){
    cancel();
    switch(choice){
        case 'Fight': fight();
            break;
        case 'Bag': bag();
            break;
        case 'Pokemon': pokemon();
            break;
    }
}
function fight() {
    var box = document.getElementById("dialog-box");
    for (let i = 0; i < pm.movelist.length; i++) { // Usa 'let' invece di 'var'
        let fightMove = document.createElement("div"); // Usa 'let'
        fightMove.id = "move" + (i);
        fightMove.move = pm.movelist[i];
        fightMove.innerHTML = fightMove.move.name;
        fightMove.classList.add("move-botton", "text-container");
        fightMove.addEventListener("click", (event) => {
            if(checkMovesStatus())
                if(fightMove.move.ppRest>0){
                    selectMove(fightMove.move.name);
                    fightMove.move.ppRest --;                    
                }
                else{
                    cantUseMove("PP is 0");
                }
            else{
                selectMove("Struggle")
            }
        });

        fightMove.addEventListener("mouseover", () => {
            fightMove.innerHTML = fightMove.move.name + "<br>" +
                                  fightMove.move.description + "<br>" +
                                  fightMove.move.ppRest + "/" + fightMove.move.pp ;
        });

        fightMove.addEventListener("mouseout", () => {
            fightMove.innerHTML = fightMove.move.name;
        });

        box.appendChild(fightMove);
    }
}

function cancel(){
    var box = document.getElementById("dialog-box");
    while (box.firstChild) {
        box.removeChild(box.lastChild);
    }
}

function selectMove(name){
    dialogBoxText(pm.name+" HAVE USED "+name);
}
function cantUseMove(reason){
    dialogBoxText(reason)
}
function dialogBoxText(text){
    var box = document.getElementById("dialog-box");
    box.innerHTML=text;
}
function checkMovesStatus(){
    for( let i = 0; i < 4; i++){
        if(pm.movelist[i].ppRest>0)
            return true
    }
    return false
}
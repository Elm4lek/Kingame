function move(name, description, pp){
    var move = {};
    move.name = name;
    move.description = description;
    move.pp = pp;
    move.ppRest = pp;
    return move;
}
var moveList = [
    move("botta","shgdsda",10),
    move("negro","shgdsda",15),
    move("botta","shgdsda",17),
    move("botta","shgdsda",5)];

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
    var choices = [];
    var box = document.getElementById("dialog-box");
    for (let i = 0; i < moveList.length; i++) { // Usa 'let' invece di 'var'
        let fightMove = document.createElement("div"); // Usa 'let'
        fightMove.id = "move" + (i + 1);
        fightMove.move = moveList[i];
        fightMove.innerHTML = fightMove.move.name;
        fightMove.classList.add("move-botton", "text-container");

        fightMove.onclick = function () {
            selectMove(fightMove.move.name);
        };
        fightMove.addEventListener("onclick", () => {
            selectMove(fightMove.move.name);
            fightMove.move.ppRest --;
        });

        fightMove.addEventListener("mouseover", () => {
            fightMove.innerHTML = fightMove.move.name + "<br>" +
                                  fightMove.move.description + "<br>" +
                                  fightMove.move.pp + "/" + fightMove.move.pp ;
        });

        fightMove.addEventListener("mouseout", () => {
            fightMove.innerHTML = fightMove.move.name;
        });

        choices.push(fightMove);
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
    var box = document.getElementById("dialog-box");
    box.innerHTML="YOU HAVE USED "+name;
}
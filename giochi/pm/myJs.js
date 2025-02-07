function move(name){
    var move = {};
    move.name = name;
    return move;
}
var moveList = [
    move("botta"),
    move("negro"),
    move("botta"),
    move("botta")];

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

function fight(){
    var choices = [];
    var box = document.getElementById("dialog-box");
    for(let i = 0 ; i < moveList.length; i++){
        var fightfightMove = document.createElement("div");
        fightMove.id = "move"+(i+1);
        fightMove.classList.add("move-botton");
        fightMove.classList.add("text-container");
        fightMove.onclick = function() {
            selectfightMove(moveList[i].name);
        };
        fightMove.addEventListener('mouseover', () => {
            hoverDiv.style.backgroundColor = 'lightcoral';
        });

        fightMove.addEventListener('mouseout', () => {
            hoverDiv.style.backgroundColor = 'lightblue';
        });
        choices.push(fightMove);
        box.appendChild(choices[i]);
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
    box.innerHTML="hai usato "+name;

}
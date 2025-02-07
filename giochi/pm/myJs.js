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
    switch(choice){
        case 'Fight': fight();
            break;
        case 'Bag': bag();
            break;
        case 'Pokemon': pokemon();
            break;
        case 'Cancel': cancel();
            break;
    }
}

function fight(){
    var choices = [];
    var box = document.getElementById("dialog-box");
    while (box.firstChild) {
        box.removeChild(box.lastChild);
    }
    for(let i = 0 ; i < 4; i++){
        choices[i] = document.createElement("div");
        choices[i].id = "move"+(i+1);
        choices[i].classList.add("move-botton");
        choices[i].classList.add("text-container");
        choices[i].innerHTML = moveList[i].name;
        choices[i].onclick = function() {
            selectMove(moveList[i].name);
        };
        box.appendChild(choices[i]);
    }

}


function selectMove(name){
    var box = document.getElementById("dialog-box");
    while (box.firstChild) {
        box.removeChild(box.lastChild);
    }
    box.innerHTML="hai usato "+name;

}
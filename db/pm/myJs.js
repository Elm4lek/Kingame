function move(name){
    var move = {};
    move.name = name;
    console.log(move);
    return move;
}
var moveList = [
    move("botta"),
    move("negro"),
    move("botta"),
    move("botta")];

console.log(moveList);
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
    choices.push(document.getElementById("choice1"));
    choices.push(document.getElementById("choice2"));
    choices.push(document.getElementById("choice3"));
    choices.push(document.getElementById("choice4"));

    for(let i = 0 ; i < 4; i++){
        choices[i].innerHTML = moveList[i].name;
        choices[i].onclick = function() {
            selectMove(moveList[i].name);
        };
    }
}


function selectMove(name){
    document.getElementById("dialog-box").innerHTML="hai usato "+name;
}
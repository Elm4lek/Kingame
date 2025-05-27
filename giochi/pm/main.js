import { setUserData,getUserData } from './const.js';
import * as Funcs from './functions.js';
var user;
var team = [];
var bag = [];
const selectType = {
    adversary : "Adversary",
    pokemon : "Pokemon",
    shop : "Shop",
    fight : "Fight"
}
document.addEventListener("DOMContentLoaded", function(event) {
    init();
})
function init(){
    let rawUserData = document.getElementById("dati").dataset.userdata;
    let userData = JSON.parse(rawUserData);
    document.getElementById("dati").remove();
    user = userData.trainer;
    team = userData.team;
    bag = userData.bag;
    console.log("user:",user);
    console.log("user:",team);
    console.log("user:",bag);
    setUserData(userData);
}

function select(type){
    Funcs.cancel();
    switch(type){
        case selectType.fight: fight();
        break;
        case selectType.pokemon: pokemon();
        break;
        case selectType.shop: shop();
        break;
        case selectType.adversary: adversary();
        break;
    }
}

function fight(){
    if(team.length<1){
        Funcs.showDialog("You don't have any Pokémon to battle with!");
        return;
    }
    //to complete
}
function pokemon(){
    
    let bag = Funcs.showBag();
}
function shop(){
    
    let bag = Funcs.showBag();
}
function adversary(){
    
    let bag = Funcs.showBag();
}

window.select = select;
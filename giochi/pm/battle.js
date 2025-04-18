import * as Funcs from './functions.js';
import * as move from './moves.js';

var playerTeam = [];
var enemyTeam = [];
var currentPlayerPokemon = 0;
var currentEnemyPokemon = 0;

function changeStatStage(target,stat,stageIncrease){
    // Calculate new stage after applying the increase/decrease
    let newStage = target.statStages[stat] + stageIncrease;

    // Make sure the stage remains within the allowed range (-6 to +6)
    newStage = Math.max(-6, Math.min(6, newStage));

    // Update the Pokémon's stat stage
    target.statStages[stat] = newStage;
}

//Create default state conditions
function createStateCondition(name,minTurns,maxTurns,onStatApply,isMoveUsable,onTurnProgress,onRemove,onSwitchOut){
    return{
        name : name,
        turnCount:0,
        minTurns:minTurns,
        maxTurns:maxTurns,
        onStatApply: onStatApply || ((target) => {}), // Default to empty function
        isMoveUsable: isMoveUsable || (() => true), // Default to always usable
        onTurnProgress: onTurnProgress || ((target) => {}), // Default empty function
        onRemove: onRemove || ((target) => {}), // Default empty function
        onSwitchOut: onSwitchOut || ((target) => {}) // Default empty function
    }
} 

const side = {
    PLAYER : 'player',
    ENEMY : 'enemy',
};

const moveType = {
    FIGHT : 'Fight',
    BAG : 'Bag',
    POKEMON : 'Pokemon',
};

//Basic status of a pokemon
const STATUS={
    NORMAL : createStateCondition(
        "NORMAL",
        Infinity, // Infinite duration for normal status
        Infinity, // Infinite duration
        (target) => {}, // No effect when applied
        () => true, // Always allow moves
        (target) => {}, // Nothing happens on turn progress
        (target) => {}, // No expiration effect
        (target) => {} // No effect on switch-out
    ),
    POISON : createStateCondition(
        "POISON",
        Infinity, // can't be removed automaticaly
        Infinity, // Infinite duration
        (target) => {}, // No effect when applied
        () => true, // Always allow moves
        (target) => {
            target.hp -= target.maxHp/8;
        }, // At the end of the round pokemon lose 1⁄8 of the maximum HP 
        (target) => {}, // No expiration effect
        (target) => {} // No effect on switch-out
    ),
    BADLY_POISON: createStateCondition(
        "BADLY_POISON",
        Infinity, // Can't be removed automatically
        Infinity,
        (target) => {
            target.status.damageCounter = 1; // Start damage counter at 1
        },
        () => true, // Moves always usable
        (target) => {
            // Lose HP based on damage counter, max 15/16 HP
            target.hp -= (target.maxHp / 16) * target.status.damageCounter;
            target.status.damageCounter = Math.min(target.status.damageCounter + 1, 15); // Increase, max at 15
        },
        (target) => {}, // No expiration effect
        (target) => {
            target.status.damageCounter = 1; // Reset damage counter on switch-out
        }
    ),
    DROWSY : createStateCondition(
        "DROWSY",
        2, // Duration 2 turns
        2, 
        (target) => {
            changeStatStage(target,"dmg",-1)//increase reviced demage for 1 stage
        }, 
        () => {true}, // Always allow moves
        (target) => {}, // Nothing happens on turn progress
        (target) => {
            changeStatus(target,STATUS.SLEEP);//change the status to sleep
            changeStatStage(target,"dmg",1);//reset the change of demage
        }, 
        (target) => {} // No effect on switch-out
    ),
    SLEEP : createStateCondition(
        "SLEEP",
        1, 
        3, 
        (target) => {}, // No effect when applied
        () => {false}, // Never allow moves
        (target) => {}, // Nothing happens on turn progress
        (target) => {}, // Nothing happens on remove
        (target) => {} // No effect on switch-out
    ),
    PARALYSIS : createStateCondition(
        "PARALYSIS",
        Infinity, 
        Infinity, 
        (target) => {
            changeStatStage(target,"spd",-2)// Speed decremented for two stage
        }, 
        () => {
            !Funcs.probability(1/4)// 25% of probability return false
        }, 
        (target) => {}, // Nothing happens on turn progress
        (target) => {
            changeStatStage(target,"spd",2)// reset speed
        }, 
        (target) => {} // No effect on switch-out
    ),
    BURN : createStateCondition(
        "BURN",
        Infinity, 
        Infinity, 
        (target) => {
            changeStatStage(target,"atk",-2)// Atk decremented for two stage
        }, 
        () => {true},//Always allows moves 
        (target) => {
            target.hp -= (target.maxHp / 16);//Lose 1/16 of max HP
        }, 
        (target) => {
            changeStatStage(target,"atk",2)// reset speed
        }, 
        (target) => {} // No effect on switch-out
    ),
    FREEZE : createStateCondition(
        "FREEZE",
        Infinity, 
        Infinity, 
        (target) => {}, //Nothing happend when apply
        () => {false},//Never allows moves 
        (target) => {
            if(Funcs.probability(1/5)){
                changeStatus(target,STATUS.NORMAL);
            }
        }, 
        (target) => {}, // Nothing happens on remove
        (target) => {} // No effect on switch-out
    ),
    FROSTBITE : createStateCondition(
        "FROSTBITE",
        Infinity, 
        Infinity, 
        (target) => {
            changeStatStage(target,"spAtk",-2)// Atk decremented for two stage
        }, 
        () => {true},//Always allows moves 
        (target) => {
            target.hp -= (target.maxHp / 16);//Lose 1/16 of max HP
            
            if(Funcs.probability(1/3)){
                changeStatus(target,STATUS.NORMAL);
            }
        }, 
        (target) => {
            changeStatStage(target,"spAtk",2)// reset speed
        }, 
        (target) => {} // No effect on switch-out
    ),
    FAINTING : createStateCondition(
        "FAINTING",
        Infinity, // Infinite duration for normal status
        Infinity, // Infinite duration
        (target) => {}, // No effect when applied
        () => false, // Never allow moves
        (target) => {}, // Nothing happens on turn progress
        (target) => {}, // No expiration effect
        (target) => {} // No effect on switch-out
    ),
};
// Function to apply a stat change
function applyStatChange(target, statChange) {
    target.statList = target.statList || [];
    target.statList.push(statChange);
}
// Stat Changes 
const STAT_CHANGES = {
    NIGHTMARE: createStateCondition(
        "Nightmare",
        Infinity,
        Infinity,
        (target) => {},
        () => {true},
        (target) => {
            if (target.status === STATUS.SLEEP) {
                target.hp -= target.maxHp / 4; // Lose 1/4 HP each turn
            } else {
                // Remove Nightmare when the Pokémon wakes up
                target.statList = target.statList.filter(
                    (change) => change.name !== "Nightmare"
                );
            }
        },
        (target) => {}, // No special expiration effect
        (target) => {
            // Remove Nightmare when switching out
            target.statList = target.statList.filter(
                (change) => change.name !== "Nightmare"
            );
        }
    ),
};
//Change status
function changeStatus(target, status){
    target.status = status;//set status of the pokemon to the new stat
    target.status.turns = Funcs.getRandomInt(status.minTurns,status.maxTurns);//get a random value to be the num of duration
    status.onStatApply(target);//apply the function of the state
}
// Define the mapping from stat stages (-6 to +6) to multipliers
const STAT_MULTIPLIERS = {
    "-6": 2 / 8,
    "-5": 2 / 7,
    "-4": 2 / 6,
    "-3": 2 / 5,
    "-2": 2 / 4,
    "-1": 2 / 3,
    "0": 1,          // No change: multiplier is 1
    "1": 3 / 2,
    "2": 2,
    "3": 2.5,
    "4": 3,
    "5": 3.5,
    "6": 4
};

var pokemon = {
    name: "pilpup",
    maxHp: 100,
    hp: 100,
    atk: 50,
    modAtk:50,
    def: 50,
    modDef: 50,
    spd: 21,
    modSpd: 21,
    spAtk: 50,
    modSpAtk: 50,
    spDef: 50,
    modSpDef: 50,
    evs : 0,
    modEvs: 0,
    movelist: [],
    statList: [],
    statStages: {
        atk: 0,
        def: 0,
        spd: 0,
        spAtk: 0,
        spDef: 0,
        dmg: 0,
        evs: 0
    },  
    status:STATUS.NORMAL
};
pokemon.movelist.push(move.agility);
pokemon.movelist.push(move.bite);
pokemon.movelist.push(move.cut);
pokemon.movelist.push(move.hit);

playerTeam.push(pokemon);

var enemy = {
    name:"pikachu",
    maxHp: 100,
    hp: 100,
    atk: 50,
    modAtk:50,
    def: 50,
    modDef: 50,
    spd: 21,
    modSpd: 21,
    spAtk: 50,
    modSpAtk: 50,
    spDef: 50,
    modSpDef: 50,
    evs : 0,
    modEvs: 0,
    movelist: [],
    statList: [],
    statStages: {
        atk: 0,
        def: 0,
        spd: 0,
        spAtk: 0,
        spDef: 0,
        dmg: 0,
        evs: 0
    }
    ,
    status:STATUS.NORMAL
};
enemy.movelist.push(move.agility);
enemy.movelist.push(move.bite);
enemy.movelist.push(move.cut);
enemy.movelist.push(move.hit);

enemyTeam.push(enemyTeam[currentEnemyPokemon]);

function select(choice){
    cancel();
    switch(choice){
        case moveType.FIGHT: fight();
            break;
        case moveType.BAG: bag();
            break;
        case moveType.POKEMON: pokemon();
            break;
    }
}

function cancel(){
    var box = document.getElementById("dialog-box");
    while (box.firstChild) {
        box.removeChild(box.lastChild);
    }
}

function fight() {
    var box = document.getElementById("dialog-box");
    for (let i = 0; i < playerTeam[currentPlayerPokemon].movelist.length; i++) {  
        let fightMove = document.createElement("div"); 
        fightMove.id = "move" + (i);
        fightMove.move = playerTeam[currentPlayerPokemon].movelist[i];
        fightMove.innerHTML = fightMove.move.name;
        fightMove.classList.add("move-botton", "text-container");
        fightMove.addEventListener("click", (event) => {
            if(checkMovesStatus())
                if(fightMove.move.ppRest>0){
                    selectMove(fightMove.move,moveType.FIGHT);
                    fightMove.move.ppRest --;                    
                }
                else{
                    cantUseMove("PP is 0");
                }
            else{
                selectMove(struggle,moveType.FIGHT);
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
function getModifiedStats(target) {
    const statsToModify = ["atk", "def", "spd", "spAtk", "spDef","evs"];
    const modifiedStats = target;

    for (let stat of target) {
        modifiedStats.push(stat);
    }
    for (let stat of statsToModify) {
        const stage = target.statStages[stat];
        const multiplier = STAT_MULTIPLIERS[stage.toString()];
        modifiedStats[stat] = target[stat] * multiplier;
    }

    return modifiedStats;
}
function canMove(target){
    if(!target.status.isMoveUsable())   return [false,target.status];//if the pokemon status' function isMoveUsable() returns false, this function return false
    target.statList.forEach(element => {
        if(!element.isMoveUsable())     return [false,element];//if one of all conditions of the pokemon's function isMoveUsable() returns false, this function return false
    });
    
    return true;//if none conditions is met, then returns true
}


function selectEnemyMove(){
    let i = Funcs.getRandomInt(0,enemyTeam[currentEnemyPokemon].movelist.length);
    return [enemyTeam[currentEnemyPokemon].movelist[i], moveType.FIGHT];
}

function movesFirst(playerMove,EnemyMove){

}

function selectFightMove(move, attaker, target){
    if(target === side.ENEMY){

    }
}

function selectMove(playerMove,playerMoveType){

   /*  let pokemon = getModifiedStats(playerTeam[currentPlayerPokemon]);
    let enemy = getModifiedStats(enemyTeam[currentEnemyPokemon]);
    let eMove = enemyMove();
    let [canMovePokemon, pmState] = canMove(pokemon);
    let [canMoveEnemy, enemyState] = canMove(enemy);
    if(move.priority < eMove.priority){
        enemyMove();
        move(target,enemy);
    }else if(move.priority > eMove.priority){
        move(target,enemy);
        enemyMove();
    }else if(pokemon.spd > enemy.spd){
        move(target,enemy);
        enemyMove();
    }else{
        enemyMove();
        move(target,enemy);
    } */
   
    let [enemyMove,enemyMoveType]  = selectEnemyMove();
    if(enemyMoveType == moveType.FIGHT && playerMoveType == moveType.FIGHT){
        movesFirst(playerMove,enemyMove);
    }else if(playerMoveType == moveType.FIGHT){
        selectFightMove(playerMove, playerTeam[currentPlayerPokemon], side.ENEMY);
    }else if(enemyMoveType == moveType.FIGHT){
        selectFightMove(enemyMove, enemyTeam[currentEnemyPokemon], side.PLAYER);
    }
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
        if(pokemon.movelist[i].ppRest>0)
            return true
    }
    return false
}

function init(){
    cancel();
    document.getElementById("enemyName").innerHTML = enemyTeam[currentEnemyPokemon].name;
    document.getElementById("currentName").innerHTML = playerTeam[currentPlayerPokemon].name;
    document.getElementById("enemyHP").innerHTML = enemyTeam[currentEnemyPokemon].hp;
    document.getElementById("currentHP").innerHTML = playerTeam[currentPlayerPokemon].hp;
}

init();

window.select = select;
window.fight = fight;
window.cancel = cancel;
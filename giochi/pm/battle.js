import * as Funcs from './functions.js';
import * as move from './moves.js';

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
        }, // At the end of the round pm lose 1⁄8 of the maximum HP 
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
            target.statStages.dmg = Math.max(pm.statStages.dmg - 1, -6);//increase reviced demage for 1 stage
        }, 
        () => {true}, // Always allow moves
        (target) => {}, // Nothing happens on turn progress
        (target) => {
            changeStatus(target,STATUS.SLEEP);//change the status to sleep
            target.statStages.dmg = Math.min(pm.statStages.dmg + 1, 6);//reset the change of demage
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
            target.statStages.spd = Math.max(pm.statStages.spd - 2, -6);// Speed decremented for two stage
        }, 
        () => {
            !Funcs.probability(1/4)// 25% of probability return false
        }, 
        (target) => {}, // Nothing happens on turn progress
        (target) => {
            target.statStages.spd = Math.max(pm.statStages.spd +2, 6);// reinpost speed
        }, 
        (target) => {} // No effect on switch-out
    ),
    BURN : createStateCondition(
        "BURN",
        Infinity, 
        Infinity, 
        (target) => {
            target.statStages.atk = Math.max(pm.statStages.atk - 2, -6);// Atk decremented for two stage
        }, 
        () => {true},//Always allows moves 
        (target) => {
            target.hp -= (target.maxHp / 16);//Lose 1/16 of max HP
        }, 
        (target) => {
            target.statStages.atk = Math.max(pm.statStages.atk +2, 6);// reinpost speed
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
            target.statStages.spAtk = Math.max(pm.statStages.spAtk - 2, -6);// Atk decremented for two stage
        }, 
        () => {true},//Always allows moves 
        (target) => {
            target.hp -= (target.maxHp / 16);//Lose 1/16 of max HP
            
            if(Funcs.probability(1/3)){
                changeStatus(target,STATUS.NORMAL);
            }
        }, 
        (target) => {
            target.statStages.spAtk = Math.max(pm.statStages.spAtk +2, 6);// reinpost speed
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
var pm = {
    name: "pilpup",
    maxHp: 100,
    hp: 100,
    atk: 50,
    def: 50,
    spd: 21,
    spAtk: 50,
    spDef: 50,
    movelist: [],
    statList: [],
    statStages: [
        atk = 0,
        def = 0,
        spd = 0,
        spAtk = 0,
        spDef = 0,
        dmg = 0,
        evs = 0,
        dmg = 0,
    ],
    status:STATUS.NORMAL
};

var enemy = {
    name:"pikachu",
    maxHp: 100,
    hp:100,
    atk:50,
    spd:20,
    movelist: [],
    buffList: [],
    status:STATUS.NORMAL
};
pm.movelist.push(accel(pm));
pm.movelist.push(hit(pm));

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
                    selectMove(fightMove);
                    fightMove.move.ppRest --;                    
                }
                else{
                    cantUseMove("PP is 0");
                }
            else{
                selectMove(struggle(pm))
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
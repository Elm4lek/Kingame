import * as Funcs from './functions.js';
import { moveType } from './const.js';
var playerTeam = [];
var enemyTeam = [];
var currentPlayerPokemon = 0;
var currentEnemyPokemon = 0;
var battleQueue = [];
var showingEvents = false;
var playerCanMove = true;
function createDialogEvent(text) {
    return {
        type: "dialog",
        text,
        play: () => showDialog(text)  // you define `showDialog()`
    };
}
function createAnimationEvent(animationFn) {
    return {
        type: "animation",
        play: animationFn
    };
}
function changeStatStage(target,stat,stageIncrease){
    let change = stageIncrease > 0 ? "incremented" : "decremented";
    // Calculate new stage after applying the increase/decrease
    let newStage = target.statStages[stat] + stageIncrease;

    // Make sure the stage remains within the allowed range (-6 to +6)
    newStage = Math.max(-6, Math.min(6, newStage));

    // Update the Pokémon's stat stage
    target.statStages[stat] = newStage;
    updateStats(target,true);
    battleQueue.push(createDialogEvent(target.name+"'s "+stat+" "+change));
}

//Create default state conditions
function createStateCondition(name, minTurns, maxTurns, onStatApply, isMoveUsable, onTurnProgress, onRemove, onSwitchOut) {
    // Use an object to store properties
    const stat = {
        name: name,
        turnCount: 0,
        minTurns: minTurns,
        maxTurns: maxTurns,
        onStatApply: function(target) {
            onStatApply(target); 
            let turns = Funcs.getRandomInt(minTurns,maxTurns);
            this.turns = turns;
        }, // set turns
        isMoveUsable: isMoveUsable || (() => true), // Default to always usable
        onTurnProgress: function(target) {
            // We use a regular function here to ensure `this` refers to the current object
            onTurnProgress(target); 
            this.turnCount++;
            if (this.turnCount >= this.turns) {
                this.onRemove(target); // Call onRemove with target as argument
            }
        },
        onRemove: onRemove || ((target) => {
            changeStatus(target, STATUS.NORMAL);
        }), // Default change stat to normal
        onSwitchOut: onSwitchOut || ((target) => {}) // Default empty function
    };

    // Return the object
    return stat;
}


const side = {
    PLAYER : 'player',
    ENEMY : 'enemy',
};

const selectType = {
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
        null, // No expiration effect
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
        null, // No expiration effect
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
        null, // No expiration effect
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
        null, // Nothing happens on remove
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
            changeStatus(target,STATUS.NORMAL)
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
            changeStatus(target,STATUS.NORMAL)
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
        null, // Nothing happens on remove
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
            changeStatus(target,STATUS.NORMAL)
        }, 
        (target) => {} // No effect on switch-out
    ),
    FAINTING : createStateCondition(
        "FAINTING",
        Infinity, // Infinite duration for normal status
        Infinity, // Infinite duration
        (target) => {
            while (target.firstChild) {
                target.removeChild(target.lastChild);
            }
        }, // When apply cancel all stat in
        () => false, // Never allow moves
        (target) => {}, // Nothing happens on turn progress
        null, // No expiration effect
        (target) => {} // No effect on switch-out
    ),
};
// Function to apply a stat change
function applyStatChange(target, statChange) {
    target.statList = target.statList || [];
    target.statList.push(statChange);
    statChange.onStatApply(target);
    battleQueue.push(createDialogEvent(target.name+" IS "+status.name));
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
    status.onStatApply(target);//apply the function of the state
    battleQueue.push(createDialogEvent(target.name+" IS "+status.name));
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
function createMove(name, type, priority, description, accuracy, pp, target, effectFunction) {
    return {
        name: name,
        type:type,
        priority : priority,
        description: description,
        accuracy: accuracy,
        pp: pp,
        ppRest: pp,
        target :target,
        use: effectFunction
    };
}

const bite = createMove("bite", "fisico", 0,"creates damage", 100, 10,"enemy", (attacker, target) => {return attacker.modAtk});
const hit = createMove("hit", "fisico", 0,"creates damage", 80, 10,"enemy", (attacker, target) => {return attacker.modAtk * 2});
const cut = createMove("cut", "fisico", 0,"cuts HP in half", 50, 10,"enemy", (attacker, target) => {return target.hp / 2});
const agility = createMove("agility","stato", 3, "Raises the user's Speed by two stages.",100, 30, "self",
    (target) => changeStatStage(target, "vel", 2) // Calls function to increase speed stage by +2
    );
    
const struggle = createMove("struggle","fisico", 0,"", 100, Infinity,"enemy",(attacker, target) => {
    attacker.hp -= Math.min(Math.round(attacker.maxHp/4),attacker.hp);
    return attacker.modAtk/2});

var pokemon = {
    name: "pilpup",
    maxHp: 500,
    hp: 500,
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
    movelist: [],
    statList: [],
    statStages: {
        atk: 0,
        def: 0,
        spd: 0,
        spAtk: 0,
        spDef: 0,
        dmg: 0,
        evs: 0,
        acc:0,
    },  
    status:STATUS.NORMAL
};
pokemon.movelist.push(agility);
pokemon.movelist.push(bite);
pokemon.movelist.push(cut);
pokemon.movelist.push(hit);

playerTeam.push(pokemon);

var enemy = {
    name:"pikachu",
    maxHp: 500,
    hp: 500,
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
    movelist: [],
    statList: [],
    statStages: {
        atk: 0,
        def: 0,
        spd: 0,
        spAtk: 0,
        spDef: 0,
        dmg: 0,
        evs: 0,
        acc:0,
    },
    status:STATUS.NORMAL
};
enemy.movelist.push(agility);
enemy.movelist.push(bite);
enemy.movelist.push(cut);
enemy.movelist.push(hit);

enemyTeam.push(enemy);

function select(choice){
    if(playerCanMove){
        cancel();
        switch(choice){
            case selectType.FIGHT: fight();
                break;
            case selectType.BAG: bag();
                break;
            case selectType.POKEMON: pokemon();
                break;
        }
    }
}

function cancel(){
    clearDialogBox();
    showDialog("select a move");
}

function clearDialogBox(){
    var box = document.getElementById("dialog-box");
    while (box.firstChild) {
        box.removeChild(box.lastChild);
    }
}

function fight() {
    clearDialogBox();
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
                    selectMove(fightMove.move,selectType.FIGHT);
                    fightMove.move.ppRest --;                    
                }
                else{
                    showDialog("PP is 0");
                }
            else{
                selectMove(struggle,selectType.FIGHT);
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
function updateStats(target, useStage = true) {
    let STAT_NAMES = ["Atk", "Def", "Spd", "SpAtk", "SpDef"];
    for (let stat of STAT_NAMES) {
        const base = "mod" + stat;
        const original = stat.toLowerCase();

        if (useStage) {
            const stage = target.statStages?.[original] ?? 0;// fallback if doesn't exist
            const multiplier = STAT_MULTIPLIERS[stage.toString()] ?? 1;// fallback if doesn't exist
            target[base] = target[original] * multiplier;
        } else {
            target[base] = target[original];
        }
    }
}

function canMove(target){
    if(!target.status.isMoveUsable())   return [false,target.status];//if the pokemon status' function isMoveUsable() returns false, this function return false
    target.statList.forEach(element => {
        if(!element.isMoveUsable())     return [false,element];//if one of all conditions of the pokemon's function isMoveUsable() returns false, this function return false
    });
    
    return true;//if none conditions is met, then returns true
}


function selectEnemyMove(){
    let i = Funcs.getRandomInt(0,enemyTeam[currentEnemyPokemon].movelist.length-1);
    console.log("enemy move index :"+i);
    return [enemyTeam[currentEnemyPokemon].movelist[i], selectType.FIGHT];
}

function movesFirst(playerMove,enemyMove){
    if (playerMove.priority !== enemyMove.priority) return playerMove.priority - enemyMove.priority;
    if (playerTeam[currentPlayerPokemon].speed !== enemyTeam[currentEnemyPokemon].speed) return playerTeam[currentPlayerPokemon].speed - enemyTeam[currentEnemyPokemon].speed;
    return Math.random() < 0.5 ? -1 : 1;
}
function viewHP(targetSide){
    let hpPercent = [
        {
            val:100,
            changeColor: (bar)=>{bar.style["background-color"] = "limegreen";}
        },
        {
            val:50,
            changeColor: (bar)=>{bar.style["background-color"] = "gold";}
        },
        {
            val:10,
            changeColor: (bar)=>{bar.style["background-color"] = "red";}
        }
    ]
    let id;
    let target;
    if(targetSide === side.ENEMY){
        id = "enemyHP";
        target = enemyTeam[currentEnemyPokemon];
    }
    else{
        id = "currentHP"; 
        target = playerTeam[currentPlayerPokemon];
    }
    let hpBar = document.getElementById(id);
    let value = Math.round(target.hp/target.maxHp*100);
    let endWidth = getComputedStyle(hpBar).getPropertyValue("--end-width");
    if (!endWidth.trim()) {
        endWidth = "100%"; // o qualunque valore default
    }
    
    // Prima imposti i valori dinamici
    hpBar.style.setProperty("--start-width", endWidth);
    hpBar.style.setProperty("--end-width", value+"%");
    hpBar.width = value+"%";
    console.log("startWidth:"+endWidth);
    console.log("endWidth:"+value);

    // Aggiungi la classe che innesca l’animazione
    hpBar.classList.add("change-bar-width");

    // Rimuovi la classe quando l'animazione è finita
    hpBar.addEventListener("animationend", function handler() {
        hpBar.classList.remove("change-bar-width");
        hpBar.style.width = hpBar.width;
        hpBar.removeEventListener("animationend", handler); // rimuovi anche il listener per evitare duplicazioni
    });
    for(let percent of hpPercent){
        if(value <= percent.val){
            percent.changeColor(hpBar);
        }
        else{
            return;
        }
    }
}
function selectFightMove(move, attacker, targetSide) {
    // Check if the attacker can move
    const attackerCanMove = canMove(attacker);
    if (Array.isArray(attackerCanMove)) {
        battleQueue.push(createDialogEvent(`${attacker.name} is ${attackerCanMove[1]}, ${attacker.name} can't move!`));
        return;
    }

    const target = targetSide === side.ENEMY ? enemyTeam[currentEnemyPokemon] : playerTeam[currentPlayerPokemon];
    const attackerSide = targetSide === side.ENEMY ? side.PLAYER : side.ENEMY;

    battleQueue.push(createDialogEvent(`${attacker.name} used ${move.name}`));

    const accStage = attacker.statStages?.acc ?? 0;
    const accMultiplier = STAT_MULTIPLIERS[accStage.toString()] ?? 1;
    const baseAccuracy = move.accuracy;

    if (move.type === moveType.state) {
        const finalAccuracy = (baseAccuracy * accMultiplier) / 100;
        if (Funcs.probability(finalAccuracy)) {
            move.use(attacker, target);
        } else {
            battleQueue.push(createDialogEvent(`${attacker.name} failed!`));
        }
        return;
    }

    // For damaging moves
    const evaStage = target.statStages?.evs ?? 0;
    const evaMultiplier = STAT_MULTIPLIERS[evaStage.toString()] ?? 1;
    const finalAccuracy = (baseAccuracy * accMultiplier / evaMultiplier) / 100;

    if (Funcs.probability(finalAccuracy)) {
        const dmg = move.use(attacker, target);
        target.hp -= Math.min(dmg, target.hp);

        battleQueue.push(createAnimationEvent(() => viewHP(targetSide)));
        battleQueue.push(createDialogEvent("Created damage"));
        battleQueue.push(createAnimationEvent(() => viewHP(attackerSide)));
    } else {
        battleQueue.push(createDialogEvent(`${target.name} avoided the attack!`));
    }
}

function selectMove(playerMove,playerMoveType){
    let [enemyMove,enemyMoveType]  = selectEnemyMove();
    console.log(enemyMove);
    if(enemyMoveType == selectType.FIGHT && playerMoveType == selectType.FIGHT){
        // Determine turn order
        let actionOrder = movesFirst(playerMove, enemyMove);

        // Define actors based on order
        let firstActor = actionOrder > 0 
            ? { move: playerMove, pokemon: playerTeam[currentPlayerPokemon], targetSide: side.ENEMY }
            : { move: enemyMove, pokemon: enemyTeam[currentEnemyPokemon], targetSide: side.PLAYER };

        let secondActor = actionOrder > 0 
            ? { move: enemyMove, pokemon: enemyTeam[currentEnemyPokemon], targetSide: side.PLAYER }
            : { move: playerMove, pokemon: playerTeam[currentPlayerPokemon], targetSide: side.ENEMY };

        // Execute first move
        selectFightMove(firstActor.move, firstActor.pokemon, firstActor.targetSide);

        // Check if first Pokémon fainted from second move
        
        checkFainting(firstActor.pokemon);
        // Check if second Pokémon is still alive
        if (checkFainting(secondActor.pokemon)) {
        } else {
            // Execute second move
            selectFightMove(secondActor.move, secondActor.pokemon, secondActor.targetSide);

            // Check again if first Pokémon fainted from second move
            checkFainting(firstActor.pokemon);
            checkFainting(secondActor.pokemon);
        }
    }else if(playerMoveType == selectType.FIGHT){
        selectFightMove(playerMove, playerTeam[currentPlayerPokemon], side.ENEMY);
        checkFainting(playerTeam[currentPlayerPokemon]);
    }else if(enemyMoveType == selectType.FIGHT){
        selectFightMove(enemyMove, enemyTeam[currentEnemyPokemon], side.PLAYER);
        checkFainting(enemyTeam[currentEnemyPokemon]);
    }
    playerTeam[currentPlayerPokemon].status.onTurnProgress();
    enemyTeam[currentEnemyPokemon].status.onTurnProgress();
    for(let stat of playerTeam[currentPlayerPokemon].statList){
        stat.onTurnProgress();
    }
    for(let stat of enemyTeam[currentEnemyPokemon].statList){
        stat.onTurnProgress();
    }
    battleQueue.push(createDialogEvent("select a move"));
    showBattleQueue(0);
}
function checkFainting(target){
    if (target.hp === 0) {
        battleQueue.push(createDialogEvent(target.name+" is fainting"));
        changeStatus(target, STATUS.FAINTING);
        return true;
    }
    return false;
}
function showDialog(reason){
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

    viewHP(side.ENEMY);
    viewHP(side.PLAYER);
}

function showBattleQueue(i = 0) {
    if (i >= battleQueue.length) {
        showingEvents = false;
        playerCanMove = true;
        while(battleQueue.length > 0) {
            battleQueue.pop();
        }
        return;
    }

    showingEvents = true;
    playerCanMove = false;

    const currentEvent = battleQueue[i];

    if (currentEvent.type === "animation") {
        // Esegui subito e vai al prossimo
        
        currentEvent.play(); // usa ?. nel caso play non esista
        showBattleQueue(i + 1);
    } else if (currentEvent.type === "dialog") {
        currentEvent.play?.();
    
        const onClick = () => {
            document.removeEventListener('click', onClick);
            showBattleQueue(i + 1);
        };
    
        // Delay per ignorare il click che ha fatto partire tutto
        setTimeout(() => {
            document.addEventListener('click', onClick);
        }, 50); // anche solo 50ms bastano
    }
    
}



init();

window.select = select;
window.fight = fight;
window.cancel = cancel;
window.selectFightMove = selectFightMove;
window.playerTeam = playerTeam;
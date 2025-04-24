import * as Funcs from './functions.js';
import { moveType } from './const.js';
var playerTeam = [];
var enemyTeam = [];
var currentPlayerPokemon = 0;
var currentEnemyPokemon = 0;
var battleQueue = [];
var isShowingEvents = false;
var playerCanMove = true;
var isBattleEnd = false;

var currentQueueIndex = 0;

var currentSelect = "";
function createDialogEvent(text) {
    return {
        type: "dialog",
        text,
        play: () => showDialog(text)  // you define `showDialog()`
    };
}
function createAnimationEvent(animationFn, isBlocked = false) {
    return {
        type: "animation",
        play: animationFn,
        isBlocked : isBlocked,
    };
}
function changePokemonEvent(side) {
    return {
        type: "changePokemon",
        side: side
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
        onRemove: onRemove || function(target){
            changeStatus(target, STATUS.NORMAL);
        }, // Default change stat to normal
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
    NORMAL : {
        name: "NORMAL",
        set : () => createStateCondition(
            "NORMAL",
            Infinity, // Infinite duration for normal status
            Infinity, // Infinite duration
            (target) => {}, // No effect when applied
            () => true, // Always allow moves
            (target) => {}, // Nothing happens on turn progress
            null, // No expiration effect
            (target) => {} // No effect on switch-out
        )
    },
    POISON : {
        name: "POISON",
        set : () => createStateCondition(
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
        )
    },
    BADLY_POISON: {
        name: "BADLY POISON",
        set : () => createStateCondition(
            "BADLY POISON",
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
        )
    },
    DROWSY : {
        name: "DROWSY",
        set : () => createStateCondition(
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
        )
    },
    SLEEP : {
        name: "SLEEP",
        set : () => createStateCondition(
            "SLEEP",
            1, 
            3, 
            (target) => {}, // No effect when applied
            () => {false}, // Never allow moves
            (target) => {}, // Nothing happens on turn progress
            null, // Nothing happens on remove
            (target) => {} // No effect on switch-out
        )
    },
    PARALYSIS : {
        name: "PARALYSIS",
        set : () => createStateCondition(
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
        )
    },
    BURN : {
        name: "BURN",
        set : () => createStateCondition(
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
        )
    },
    FREEZE : {
        name: "FREEZE",
        set : () => createStateCondition(
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
        )
    },
    FROSTBITE :{
        name: "FROSTBITE",
        set : () => createStateCondition(
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
        )
    },
    FAINTING : {
        name: "FAINTING",
        set : () => createStateCondition(
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
        )
    },
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
            if (target.status.name === STATUS.SLEEP.name) {
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
    target.status = status.set();//set status of the pokemon to the new stat
    target.status.onStatApply(target);//apply the function of the state
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
const cut = createMove("cut", "fisico", 0,"cuts HP in half", 50, 10,"enemy", (attacker, target) => {return target.maxHp / 2});
const agility = createMove("agility","stato", 3, "Raises the user's Speed by two stages.",100, 30, "self",
    (target) => changeStatStage(target, "vel", 2) // Calls function to increase speed stage by +2
    );
    
const struggle = createMove("struggle","fisico", 0,"", 100, Infinity,"enemy",(attacker, target) => {
    attacker.hp -= Math.min(Math.round(attacker.maxHp/4),attacker.hp);
    return attacker.modAtk/2});

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
    let bag = document.getElementById("bag");
    if(bag){
        let parent = bag.parentElement;
        parent.removeChild(bag);
    }
}

function clearDialogBox(){
    var box = document.getElementById("dialog-box");
    while (box.firstChild) {
        box.removeChild(box.lastChild);
    }
}

function fight() {
    clearDialogBox();
    currentSelect = selectType.FIGHT;
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
                    selectMove(fightMove.move);
                    fightMove.move.ppRest --;                    
                }
                else{
                    showDialog("PP is 0");
                }
            else{
                selectMove(struggle);
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
function viewHp(target, id){
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
    
    let hpBar = document.getElementById(id);
    let value = Math.round(target.hp/target.maxHp*100);
    let endWidth = getComputedStyle(hpBar).getPropertyValue("--end-width");
    if (!endWidth.trim()) {
        endWidth = "100%"; // max if wasn't setted
    }
    
    // Prima imposti i valori dinamici
    hpBar.style.setProperty("--start-width", endWidth);
    hpBar.style.setProperty("--end-width", value+"%");
    hpBar.width = value+"%";
/*     console.log("startWidth:"+endWidth);
    console.log("endWidth:"+value); */

    // Aggiungi la classe che innesca l’animazione
    hpBar.classList.add("change-bar-width");
    for(let percent of hpPercent){
        if(value <= percent.val){
            percent.changeColor(hpBar);
        }
        else{
            return hpBar;
        }
    }
    return hpBar;
}
function viewCurrentHP(targetSide){
    
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
    changeHPFill(target,id);
}
function changeHPFill(target,id){
    let hpBar = viewHp(target,id);
    
    // Rimuovi la classe quando l'animazione è finita
    hpBar.addEventListener("animationend", function handler() {
        hpBar.classList.remove("change-bar-width");
        hpBar.style.width = hpBar.width;
        hpBar.removeEventListener("animationend", handler); // rimuovi anche il listener per evitare duplicazioni
    });
}
function selectFightMove(move, attacker, targetSide) {
    // Check if the attacker can move
    const attackerCanMove = canMove(attacker);
    if (Array.isArray(attackerCanMove)) {
        battleQueue.push(createDialogEvent(`${attacker.name} is ${attackerCanMove[1]}, ${attacker.name} can't move!`));
        return;
    }

    const target = targetSide === side.ENEMY ? enemyTeam[currentEnemyPokemon] : playerTeam[currentPlayerPokemon];
    const attackerSide = getOppositeSide(targetSide);

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

        battleQueue.push(createAnimationEvent(() => viewCurrentHP(targetSide)));
        battleQueue.push(createDialogEvent("Created damage"));
        battleQueue.push(createAnimationEvent(() => viewCurrentHP(attackerSide)));
    } else {
        battleQueue.push(createDialogEvent(`${target.name} avoided the attack!`));
    }
}

function selectMove(playerMove){
    battleQueue.push(createAnimationEvent(()=>cancel()));
    playerCanMove = false;
    let [enemyMove,enemyMoveType]  = selectEnemyMove();
    if(enemyMoveType == selectType.FIGHT && currentSelect == selectType.FIGHT){
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
        
        checkFainting(firstActor.pokemon,getOppositeSide(firstActor.targetSide));
        if(!isBattleEnd){
            // Check if second Pokémon is still alive
            checkFainting(secondActor.pokemon, getOppositeSide(secondActor.targetSide));
            if(!isFainting(firstActor.pokemon)&&!isFainting(secondActor.pokemon)){
                // Execute second move
                selectFightMove(secondActor.move, secondActor.pokemon, secondActor.targetSide);
                checkFainting(firstActor.pokemon,getOppositeSide(firstActor.targetSide));
                checkFainting(secondActor.pokemon, getOppositeSide(secondActor.targetSide));
            }
        }
    }else{
        if(currentSelect == selectType.FIGHT){
            selectFightMove(playerMove, playerTeam[currentPlayerPokemon], side.ENEMY);
        }else if(enemyMoveType == selectType.FIGHT){
            selectFightMove(enemyMove, enemyTeam[currentEnemyPokemon], side.PLAYER);
        }
        checkFainting(enemyTeam[currentEnemyPokemon], side.ENEMY);
        if(!isBattleEnd) checkFainting(playerTeam[currentPlayerPokemon], side.PLAYER);
    }
    // Check if second Pokémon is still alive
    checkFainting(enemyTeam[currentEnemyPokemon], side.ENEMY);
    if(!isBattleEnd){
        checkFainting(playerTeam[currentPlayerPokemon], side.PLAYER);

        playerTeam[currentPlayerPokemon].status.onTurnProgress();
        enemyTeam[currentEnemyPokemon].status.onTurnProgress();
        for(let stat of playerTeam[currentPlayerPokemon].statList){
            stat.onTurnProgress();
        }
        for(let stat of enemyTeam[currentEnemyPokemon].statList){
            stat.onTurnProgress();
        }
    }
    console.log("battle queue",battleQueue);
    showBattleQueue(0);
}

function checkFainting(target,targetSide){
    if(isFainting(target)){
        changeStatus(target, STATUS.FAINTING);
        battleQueue.push(createDialogEvent(target.name+" is fainting"));
        handleFainting(targetSide);
    }
}

function isFainting(target){
    if (target.hp === 0) {
        return true;
    }
    return false;
}

function handleFainting(targetSide) {
    let team = getTeam(targetSide);
    console.log("handle fainting");
    if (isTeamDefeated(team)) {
        console.log("end battle");
        endBattle(targetSide);
    }
    else{
        console.log("change pokemon");
        battleQueue.push(changePokemonEvent(targetSide));
    }
}

function isTeamDefeated(team){
    for(let pokemon of team){
        if(!isFainting(pokemon)) return false;
    }
    return true;
}

function getTeam(side){
    console.log(side);
    return side === side.PLAYER ? playerTeam : enemyTeam;
}

function pokemon(){
    currentSelect = selectType.POKEMON;
    showPokemon();
}
function showPokemon(){
    let bagItems = showBag();
    bagItems.dataset.selected = "";
    bagItems.className = "pokemon-list";
    for(let [i,pokemon] of playerTeam.entries()){
        if(i === currentPlayerPokemon && currentSelect === selectType.POKEMON) continue;
        let canSelect = true;
        if(currentSelect === selectType.POKEMON && pokemon.status.name === STATUS.FAINTING.name) canSelect = false;
        let div = document.createElement("div");
        div.className = "bag-item";
        div.id = "pokemon"+i;
        bagItems.appendChild(div);
        if(canSelect){
            div.addEventListener('click', ()=>{
                let lastSelected = document.getElementById(bagItems.dataset.selected);
                if (lastSelected) {
                    lastSelected.classList.remove("item-selected");
                }
                bagItems.dataset.selected = div.id;
                div.classList.add("item-selected");
                let button = document.getElementById("select");
                if(!button){
                    button = document.createElement("input");
                    button.type = "button";
                    button.id="select";
                    button.className="button";
                    button.value="SELECT";
                    let bagBottom = document.getElementById("bag-bottom");
                    bagBottom.appendChild(button);
                }
                button.addEventListener('click', ()=>{
                    if(isShowingEvents)
                        forcedChangePokemon(side.PLAYER,i);
                    else
                        selectedChangePokemon(side.PLAYER,i);
                });

            });
        }

        let img = document.createElement("div");
        img.className = "list-img";
        div.appendChild(img);      

        let details = document.createElement("div");
        details.className= "list-details";  
        div.appendChild(details);
        
        let name = document.createElement("div");
        name.className = "half-container description-name";
        name.innerHTML = pokemon.name;
        details.appendChild(name);
        let hp = document.createElement("div");
        hp.className = "half-container";
        hp.style["align-items"] = "baseline";
        details.appendChild(hp);

        let hpBar = document.createElement("div");
        hpBar.className = "hp-bar";
        hp.appendChild(hpBar);

        let hpFill = document.createElement("div");
        hpFill.id = "pokemon"+i+"HP";
        hpFill.className = "hp-fill";
        hpBar.appendChild(hpFill);
        viewHp(pokemon,hpFill.id);
    }
}
//show the default layer of bag
function showBag(){
    let content = document.getElementById("content");
    let bag = document.createElement("div");
    bag.id = "bag";
    content.appendChild(bag);

    let bagLeft = document.createElement("div");
    bagLeft.id = "bag-left";
    let bagRight = document.createElement("div");
    bagRight.id = "bag-right";
    bag.appendChild(bagLeft);
    bag.appendChild(bagRight);

    let bagItems = document.createElement("div");
    bagItems.id = "bag-items";
    let bagBottom = document.createElement("div");
    bagBottom.id = "bag-bottom";
    bagRight.appendChild(bagItems);
    bagRight.appendChild(bagBottom);

    return bagItems;
}
function changePokemon(targetSide,i){
    let team = getTeam(targetSide);
    let currentPokemon = targetSide === side.PLAYER ? currentPlayerPokemon : currentEnemyPokemon;
    let nameId = targetSide === side.PLAYER ? "currentName" : "enemyName";
    let hpId = targetSide === side.PLAYER ? "currentHP" : "enemyHP";
    team[currentPokemon].status.onSwitchOut(team[currentPokemon]);

    for(let stat of team[currentPokemon].statList){
        stat.onSwitchOut(team[currentPokemon]);
    }
    targetSide === side.PLAYER ? currentPlayerPokemon = i : currentEnemyPokemon = i;

    let name = document.getElementById(nameId);
    name.innerHTML = team[currentPokemon].name;
    viewHp(team[currentPokemon],hpId);

    battleQueue.push(createDialogEvent("changed pokemon"));
    cancel();
    console.log("is showing envents:"+isShowingEvents);
}
function selectedChangePokemon(targetSide,i){
    changePokemon(targetSide,i);
    selectMove(null);
}
function forcedChangePokemon(targetSide,i){
    changePokemon(targetSide,i);    
    showBattleQueue(currentQueueIndex+1);
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
        if(playerTeam[currentPlayerPokemon].movelist[i].ppRest>0)
            return true;
    }
    return false;
}
function getOppositeSide(side){
    return side === side.ENEMY ? side.PLAYER : side.ENEMY;
}
function init(){
    cancel();
        
    let pokemon = {
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
            evs: -6,
            acc:0,
        },  
        //status:STATUS.NORMAL.set()
    };

    let enemy = {
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
        status:STATUS.NORMAL.set()
    };
    
    let pm1 = structuredClone(pokemon);
    pm1.status = STATUS.NORMAL.set();
    let pm2 = structuredClone(pokemon);
    pm2.status = STATUS.NORMAL.set();
    pokemon.status = STATUS.NORMAL.set();

    pm1.movelist.push(agility);
    pm1.movelist.push(bite);
    pm1.movelist.push(cut);
    pm1.movelist.push(hit);
    
    pm2.movelist.push(agility);
    pm2.movelist.push(bite);
    pm2.movelist.push(cut);
    pm2.movelist.push(hit);
    
    pokemon.movelist.push(agility);
    pokemon.movelist.push(bite);
    pokemon.movelist.push(cut);
    pokemon.movelist.push(hit);
    playerTeam.push(pokemon);

/*     enemy.movelist.push(agility);
    enemy.movelist.push(bite);
    enemy.movelist.push(hit); */
    enemy.movelist.push(cut);
    

    playerTeam.push(pm1);
    playerTeam.push(pm2);

    enemyTeam.push(enemy);

    document.getElementById("enemyName").innerHTML = enemyTeam[currentEnemyPokemon].name;
    document.getElementById("currentName").innerHTML = playerTeam[currentPlayerPokemon].name;

    viewCurrentHP(side.ENEMY);
    viewCurrentHP(side.PLAYER);
    let enemyPokemonCount = document.getElementById("enemyPokemonCount");
    for(let i in enemyTeam){
        let pokeball = document.createElement("div");
        pokeball.className = "pokeball";
        enemyPokemonCount.appendChild(pokeball);
    }
    let playerPokemonCount = document.getElementById("playerPokemonCount");
    for(let i in playerTeam){
        let pokeball = document.createElement("div");
        pokeball.className = "pokeball";
        playerPokemonCount.appendChild(pokeball);
    }
}

function showBattleQueue(i = 0) {
    if (i >= battleQueue.length) {
        isShowingEvents = false;
        playerCanMove = true;
        while(battleQueue.length > 0) {
            battleQueue.pop();
        }
        showDialog("select a move");
        return;
    }

    isShowingEvents = true;
    playerCanMove = false;

    const currentEvent = battleQueue[i];

    console.log(i+" event:",currentEvent);

    if( currentEvent.type === "changePokemon"){
        pokemon();
        currentQueueIndex = i;
    }
    else if (currentEvent.type === "animation") {
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

function endBattle(side){
    playerCanMove = false;
    isBattleEnd = true
    battleQueue.push(createDialogEvent(side+" win"));
}

init();

window.select = select;
window.fight = fight;
window.cancel = cancel;
window.selectFightMove = selectFightMove;
window.playerTeam = playerTeam;
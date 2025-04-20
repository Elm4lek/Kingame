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

// Attack move factory (like `atkMove`)
function atkMove(name, description, pp, damageFormula) {
    return function (attacker) {
        return createMove(name, description, pp, function (target) {
            let damage = damageFormula(attacker, target);
            target.hp -= damage;
            return damage;
        });
    };
}

export const bite = createMove("bite", "fisico", 3,"creates damage", 100, 10,"enemy", (attacker, target) => {return attacker.modAtk});
export const hit = createMove("hit", "fisico", 3,"creates damage", 80, 10,"enemy", (attacker, target) => {return attacker.modAtk * 2});
export const cut = createMove("cut", "fisico", 3,"cuts HP in half", 50, 10,"enemy", (attacker, target) => {return target.hp / 2});
export const agility = createMove("agility","stato", 1, "Raises the user's Speed by two stages.",100, 30, "self",
    (target) => changeStatStage(target, "vel", 2) // Calls function to increase speed stage by +2
    );
    
export const struggle = createMove("struggle", "", 0, (attacker, target) => {
    attacker.hp -= Math.min(Math.round(attacker.maxHp/4),attacker.hp);
    return attacker.modAtk/2});

    
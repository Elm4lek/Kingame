function createMove(name, type, priority, description, pp,target, effectFunction) {
    return {
        name: name,
        type:type,
        priority : priority,
        description: description,
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

export const bite = createMove("bite", "fisico", 3,"creates damage", 10,"enemy", (attacker, target) => {return attacker.atk});
export const hit = createMove("hit", "fisico", 3,"creates damage", 10,"enemy", (attacker, target) => {return attacker.atk * 2});
export const cut = createMove("cut", "fisico", 3,"cuts HP in half", 10,"enemy", (attacker, target) => {return target.hp / 2});
export const agility = createMove("agility", 1,"stato", "Raises the user's Speed by two stages.", 30, "self",
    (target) => changeStatStage(target, "vel", 2) // Calls function to increase speed stage by +2
    );
    
export const struggle = createMove("struggle", "", 0, (attacker, target) => {
    attacker.hp -= Math.round(attacker.maxHp/4);
    return attacker.atk/2});

    
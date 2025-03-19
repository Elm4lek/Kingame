function createMove(name, description, pp, effectFunction) {
    return {
        name: name,
        description: description,
        pp: pp,
        ppRest: pp,
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

export const bite = createMove("bite", "creates damage", 10, (attacker, target) => attacker.atk);
export const hit = createMove("hit", "creates damage", 10, (attacker, target) => attacker.atk * 2);
export const cut = createMove("cut", "cuts HP in half", 10, (attacker, target) => target.hp / 2);
export const agility = createMove("Agility", "Raises the user's Speed by two stages.", 30, 
    (target) => changeStatStage(target, "vel", 2) // Calls function to increase speed stage by +2
    );
    
export const struggle = createMove("struggle", "", 0, (attacker, target) => {
    attacker.hp -= Math.round(attacker.maxHp/4);
    attacker.atk/2})
export function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
export function probability(p) {
    return Math.random() < p;
}
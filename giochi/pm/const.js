export const moveType = {
    physic : "fisico",
    special : "speciale",
    state : "stato", 
};

let _userData = {};

export function setUserData(newData) {
  _userData = newData;
}

export function getUserData() {
  return _userData;
}
let _shop = {};

export function setShop(newData) {
  _shop = newData;
}

export function getShop() {
  return _shop;
}
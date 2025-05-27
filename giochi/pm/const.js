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
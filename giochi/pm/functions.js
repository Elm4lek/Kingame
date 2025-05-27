export function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
  
export function probability(p) {
  return Math.random() < p;
}

export function showDialog(reason){
    dialogBoxText(reason)
}
export function dialogBoxText(text){
    var box = document.getElementById("dialog-box");
    box.innerHTML=text;
}
export function showBag() {
    cancel();
    const content = document.getElementById("content");
    const bag = document.createElement("div");
    bag.id = "bag";
    content.appendChild(bag);

    const bagLeft = document.createElement("div");
    bagLeft.id = "bag-left";
    const bagRight = document.createElement("div");
    bagRight.id = "bag-right";
    bag.appendChild(bagLeft);
    bag.appendChild(bagRight);

    const bagItems = document.createElement("div");
    bagItems.id = "bag-items";
    const bagBottom = document.createElement("div");
    bagBottom.id = "bag-bottom";
    bagRight.appendChild(bagItems);
    bagRight.appendChild(bagBottom);

    return bagItems;
}

export function cancel(){
    clearDialogBox();
    let bag = document.getElementById("bag");
    if(bag){
        let parent = bag.parentElement;
        parent.removeChild(bag);
    }
}
export function clearDialogBox(){
    var box = document.getElementById("dialog-box");
    while (box.firstChild) {
        box.removeChild(box.lastChild);
    }
}
import { setUserData,getUserData, setShop, getShop } from './const.js';
import * as Funcs from './functions.js';
var user;
var team = [];
var bag = [];
var playerMoney;
const selectType = {
    adversary : "Adversary",
    pokemon : "Pokemon",
    shop : "Shop",
    fight : "Fight"
}
document.addEventListener("DOMContentLoaded", function(event) {
    init();
})
function init(){
    let rawUserData = document.getElementById("dati").dataset.userdata;
    let userData = JSON.parse(rawUserData);
    document.getElementById("dati").remove();
    let shopData = JSON.parse(document.getElementById("shop-data").textContent);

    document.getElementById("shop-data").remove();
    user = userData.trainer;
    team = userData.team;
    bag = userData.bag;
    setUserData(userData);
    setShop(shopData);
    console.log(user);
    console.log(shopData);
    playerMoney = 400000;
}

function select(type){
    Funcs.cancel();
    switch(type){
        case selectType.fight: fight();
        break;
        case selectType.pokemon: pokemon();
        break;
        case selectType.shop: shop();
        break;
        case selectType.adversary: adversary();
        break;
    }
}

function fight(){
    if(team.length<1){
        Funcs.showDialog("You don't have any Pokémon to battle with!");
        return;
    }
    //to complete
}
function pokemon(){
    let bag = Funcs.showBag();
}
function shop(){
    let bagItems = Funcs.showBag();
    bagItems.dataset.selected = "";
    bagItems.className = "bag-list";
    let items = getShop();
    items.forEach((item, i) => {
        const div = createBagItem({
            id: item.nome,
            name: item.nome,
            description: item.descrizione,
            price: item.prezzo,
            onClick: () => {
                Funcs.handleSelection(bagItems, div.id);
                createShopItemUI(item.nome);
            }
            
        });
        bagItems.appendChild(div);
    });
    let bagLeft = document.getElementById("bag-left");
    let descriptionBox = document.createElement("div");
    bagLeft.append(descriptionBox);
    descriptionBox.classList.add("half-container");
    descriptionBox.id = "pocketBox";
    let descriptionBoxText = document.createElement("div");
    descriptionBoxText.innerHTML = "pocket";
    descriptionBoxText.className = "half-container description-name";
    descriptionBox.appendChild(descriptionBoxText);
    let pocket = document.createElement("div");
    pocket.innerHTML = "pocket";
    pocket.innerHTML = "$"+user.Soldi;
    pocket.className = "half-container description-name";
    descriptionBox.appendChild(pocket);
}
function createBagItem(item){
    const div = document.createElement("div");
    div.className = "bag-item";
    div.id = item.id;
    if (item.onClick) {
        div.addEventListener("click", item.onClick);
    }
    if(item.img){        
        const img = document.createElement("div");
        img.className = "list-img";
        const itemImg = document.createElement("img");
        img.src = item.img;
        div.appendChild(img);
        img.appendChild(itemImg);
    }
    else{
        const img = document.createElement("div");
        img.className = "list-img";
        div.appendChild(img);
    }
    const details = document.createElement("div");
    details.className = "list-details";
    div.appendChild(details);

    const nameDiv = document.createElement("div");
    nameDiv.className = "half-container description-name object-name";
    nameDiv.innerHTML = item.name;
    details.appendChild(nameDiv);

    if (item.description) {
        const descDiv = document.createElement("div");
        descDiv.className = "half-container description-name";
        descDiv.innerHTML = item.description;
        details.appendChild(descDiv);
    }

    if (item.price !== null && item.price !== undefined) {
        const data = document.createElement("div");
        data.className = "list-data";
        data.innerHTML = "$"+item.price;
        div.appendChild(data);
    } else {
        const data = document.createElement("div");
        data.className = "list-data";
        div.appendChild(data);
    }

    return div;
}
function createShopItemUI(itemName) {
    let shop = getShop();
    const item = shop.find(i => i.nome === itemName);
    let bagItem = bag.find(i => i.nome === itemName)
    if(!bagItem){
        bagItem = [];
        bagItem.Numero = 0;
    }
    if (!item) return;

    let quantity = 1;

    const container = document.createElement("div");
    container.className = "shop-item";

    const title = document.createElement("h3");
    title.style.margin = 0;
    title.textContent = ` NOW HAVE ${bagItem.Numero} ${item.nome}`;

    const quantityControl = document.createElement("div");
    quantityControl.className = "quantity-control";

    const leftArrow = document.createElement("span");
    leftArrow.textContent = "←";
    leftArrow.className = "arrow";

    const quantityDisplay = document.createElement("span");
    quantityDisplay.textContent = quantity;

    const rightArrow = document.createElement("span");
    rightArrow.textContent = "→";
    rightArrow.className = "arrow";

    const priceDisplay = document.createElement("input");
    priceDisplay
    priceDisplay.value = `Price: ${item.prezzo * quantity}`;

    const updatePrice = () => {
    const total = item.prezzo * quantity;
    priceDisplay.value = `Price: ${total}`;
    quantityDisplay.textContent = quantity;
    };

    leftArrow.onclick = () => {
    if (quantity > 1) {
        quantity--;
        updatePrice();
    }
    };

    rightArrow.onclick = () => {
        const total = item.prezzo * (quantity + 1);
        console.log("increment called");
        console.log("quantity:"+quantity);
        console.log("item.price:"+item.price);
        console.log("total:"+total);
        console.log("playerMoney:"+playerMoney);
        console.log("quantity < 99:"+(quantity < 99));
        console.log("total <= playerMoney:"+(total <= playerMoney));
    if (quantity < 99 && total <= playerMoney) {
        quantity++;
        updatePrice();
    }
    };

    quantityControl.appendChild(leftArrow);
    quantityControl.appendChild(quantityDisplay);
    quantityControl.appendChild(rightArrow);

    container.appendChild(title);
    container.appendChild(quantityControl);
    quantityControl.appendChild(priceDisplay);

    document.getElementById("bag-bottom").appendChild(container);
}
async function adversary() {
    let bag = Funcs.showBag(); // Suppongo sia sincrona

    let trainerParams = {
        id: user.Livello
    };

    const result = await post(trainerParams, "http://localhost/Kingame/giochi/pm/getTrainerData.php");

    if (result) {
        const { trainer, bag: trainerBag, team } = result;

        console.log("Trainer:", trainer);
    } else {
        console.error("Errore nella richiesta trainer.");
    }
}


async function post(params, url) {
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(params),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        return data;
    } catch (error) {
        return null;
    }
}


window.select = select;
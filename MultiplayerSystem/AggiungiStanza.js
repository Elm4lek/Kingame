var elencoStanze = [];
async function fetchStanze() {
    console.log("fetched");
    elencoStanze.splice(0, elencoStanze.length);

    const response = await fetch("http://"+host+"/kingame/MultiplayerSystem/CercaStanze.php");
    const risposta = await response.json();

    for (let i = 0; i < risposta.length; i++) {
        if (risposta[i]['numero'] != risposta[i]['giocatore']) {
            elencoStanze.push(risposta[i]);
        }
    }
}
//
document.addEventListener("DOMContentLoaded", function(event) {
    init()
});

async function init(){    
    await fetchStanze();
    selezionaGioco();
}
function selezionaGioco(){
    var stanze = [];

    var stanzeList;
    var myParent = document.getElementById('Stanza');
    var hasChild = myParent.querySelector("#codStanza") != null;

    if(hasChild){
        stanzeList = document.getElementById('codStanza');
        while(stanzeList.hasChildNodes()){
            stanzeList.removeChild(stanzeList.firstChild);
        }
    }
    else{
        stanzeList = document.createElement("select");
        stanzeList.id = "codStanza";
        stanzeList.setAttribute("onchange", 'stanzaSelezionata()');
        myParent.appendChild(stanzeList);
    }
    for(let i = 0; i < elencoStanze.length; i++ ){
        stanze.push(elencoStanze[i]['stanza']);
    }
    
    for(let i = 0; i < stanze.length; i++ ){
        var option = document.createElement("option");
        option.value = stanze[i];
        option.text = stanze[i];
        stanzeList.appendChild(option);
    }
    stanzaSelezionata();
}

var stanzaEsistente = false;

var input = document.getElementById('inputStanza');
input.addEventListener("input", function(event) {
    var check = document.getElementById('checkStanza');
    var value = input.value;

    var haStanza = false;
    let index;
    for(let i = 0; i < elencoStanze.length; i++){
        if(elencoStanze[i]['stanza'] === Number(value)){
            index = i;
            haStanza = true;
        }
    }
    if(haStanza){
        if(check.innerHTML != ''){
            check.innerHTML = '';
        }
        stanzaEsistente = true;
        if(!document.getElementById('aggiungiButtonInsert').hasChildNodes()){
            aggiungiStanza("aggiungiButtonInsert",{"id":value,
                "gioco":elencoStanze[index]["gioco"],
                "numero":elencoStanze[index]["numero"]});
        }
    }
    else{
        if(value != ''){
            check.innerHTML = 'codice stanza non esistente';
        }
        else{
            check.innerHTML = '';
        }
        removeChildNode('aggiungiButtonInsert');
        stanzaEsistente = false;
    }
});

function aggiungiStanza(padre, stanza){
    var p = document.getElementById(padre);
    var button = document.createElement('input');
    button.setAttribute('type','button');
    button.setAttribute('value', 'Unisciti');
    button.stanza = stanza.id;
    button.addEventListener("click",function(){
        cambiaStanza(stanza);
    })
    p.appendChild(button);
}

function stanzaSelezionata(){
    if(document.getElementById('codStanza').length > 0){
        removeChildNode('aggiungiButtonSelect');
        var st = $("#codStanza")[0].value;
        let index;
        for(let i = 0; i < elencoStanze.length; i++){
            if(elencoStanze[i]['stanza'] === Number(st)){
                index = i;
            }
        }
        console.log(elencoStanze[index]);
        aggiungiStanza("aggiungiButtonSelect",{
            "id":elencoStanze[index]["stanza"],
            "gioco":elencoStanze[index]["gioco"],
            "numero":elencoStanze[index]["numero"]});
    }
    else{
        removeChildNode("aggiungiButtonSelect");
    }
}

function cambiaStanza(value){
    var parametri = {
        tipo:'aggiunta',
        stanza:Number(value.id),
        gioco:value.gioco,
        numero:value.numero
    };
    console.log(parametri);
    post('http://'+host+'/kingame/MultiplayerSystem/CreaStanza.php',parametri);
}

function removeChildNode(padre){
    if(document.getElementById(padre).hasChildNodes()){
        document.getElementById(padre).removeChild(document.getElementById(padre).firstChild);
    }
}

function post(path, params, method='post') {

    const form = document.createElement('form');
    form.method = method;
    form.action = path;
  
    for (const key in params) {
      if (params.hasOwnProperty(key)) {
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = key;
        hiddenField.value = params[key];
  
        form.appendChild(hiddenField);
      }
    }
  
    document.body.appendChild(form);
    form.submit();
}
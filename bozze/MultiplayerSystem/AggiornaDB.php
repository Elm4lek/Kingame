<?php
// Create connection
$stanza = $_POST['stanza'];
$gioco = $_POST['gioco'];
$num = $_POST['num'];
$giocatore = $_POST['giocatore'];

$conn = new mysqli("localhost","root","","kingame")  or die (mysql_error())

if($tipo == 'crea'){
    aggiungiStanza($stanza,$gioco,$num,$giocatore);
}
else{
    aggiungiGiocatore($stanza,$giocatore);
}

function aggiungiStanza($stanza,$gioco,$num,$giocatore){
    $sql = "INSERT INTO stanze(Id, Gioco, Numero) VALUES (".$stanza.",".$gioco.",".$num.")"; 
    $con->query($sql);
    aggiungiGiocatore($stanza,$giocatore);
}
function aggiungiGiocatore($stanza,$giocatore){
    $sql = "INSERT INTO giocatori(Stanza, Giocatore) VALUES (".$stanza.",".$giocatore.")"; 
    $con->query($sql);
}
$con->close();

?>
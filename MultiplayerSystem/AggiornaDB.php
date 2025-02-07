<?php
// Create connection

$tipo = $_POST[0]['tipo'];

$conn = new mysqli("localhost","root","","kingame")  or die (mysql_error())

if($tipo == 'crea'){
    aggiungiStanza();
}
else{
    aggiungiGiocatore();
}

function aggiungiStanza(){
    
    $stanza = $_POST[1][0]['stanza'];
    $gioco = $_POST[1][0]['gioco'];
    $num = $_POST[1][0]['num'];

    $sql = "INSERT INTO stanze(Id, Gioco, Numero,In_Sessione) VALUES (".$stanza.",".$gioco.",".$num.",1)"; 
    $con->query($sql);
    aggiungiGiocatore();
}
function aggiungiGiocatore(){
    $giocatore = $_POST[1][1]['giocatore'];
    $stanza = $_POST[1][1]['stanza'];
    $gioco = $_POST[1][1]['gioco'];
    $sql = "INSERT INTO sessione(Stanza, Giocatore, Gioco, "."Data".", In_Sessione) VALUES (".$stanza.",".$giocatore.",".$gioco.",0,".date("Y-m-d").",1)"; 
    $con->query($sql);
}
$con->close();

?>
<?php
require_once '../db_connect.php';

$tipo = $_POST['tipo'];
$data = $_POST['data'];
echo "<pre>";
print_r($data);
echo "</pre>";

if ($tipo == 'crea') {
    aggiungiStanza($data);
} else {
    aggiungiGiocatore($data);
}

function aggiungiStanza($data) {
    global $conn;

    $stanza = $data[0]['stanza'];
    $gioco = $data[0]['gioco'];

    $sql = "INSERT INTO stanze(Id, Gioco, Data, Stato) VALUES ('".$stanza."', '".$gioco."', '".date("Y-m-d")."', 0)";
    echo date("Y-m-d");
    echo "<br>0".$sql."<br";
    if ($conn->query($sql) === TRUE) {
        echo "Stanza aggiunta con successo.<br>";
    } else {
        echo "Errore aggiunta stanza: " . $conn->error . "<br>";
    }

    aggiungiGiocatore($data);
}

function aggiungiGiocatore($data) {
    global $conn;

    $giocatore = $data[1]['giocatore'];
    $stanza = $data[1]['stanza'];

    $sql = "INSERT INTO sessione (Stanza, User)
            VALUES (".$stanza.", '".$giocatore."')";
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "Giocatore aggiunto con successo.<br>";
    } else {
        echo "Errore aggiunta giocatore: " . $conn->error . "<br>";
    }
}

$conn->close();

?>
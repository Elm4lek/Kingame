<?php

// Create connection
$conn = new mysqli("localhost", "root", "", "kingame");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$tipo = $_POST['tipo'];
$data = $_POST['data'];

// Debugging: Print received data
// var_dump($tipo, $data);

if ($tipo == 'crea') {
    aggiungiStanza($data);
} else {
    aggiungiGiocatore($data);
}

function aggiungiStanza($data) {
    global $conn;

    $stanza = $data[0]['stanza'];
    $gioco = $data[0]['gioco'];
    $num = $data[0]['num'];

    $sql = "INSERT INTO stanze(Id, Gioco, Numero, In_Sessione) VALUES ($stanza, $gioco, $num, 1)";
    
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
    $gioco = $data[1]['gioco'];

    $sql = "INSERT INTO sessione (Stanza, Giocatore, Gioco, Data, In_Sessione) 
            VALUES ($stanza, $giocatore, $gioco, '" . date("Y-m-d") . "', 1)";

    if ($conn->query($sql) === TRUE) {
        echo "Giocatore aggiunto con successo.<br>";
    } else {
        echo "Errore aggiunta giocatore: " . $conn->error . "<br>";
    }
}

// Close connection
$conn->close();

echo "Aggiornamento fatto";
?>

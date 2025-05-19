<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$json = file_get_contents('php://input');

// Decodifica il JSON in un array associativo
$post = json_decode($json, true);  // True per ottenere un array, false per un oggetto

// Verifica se "score" è presente nel payload
if (isset($post["score"])) {
    $score = $post["score"];

    // Controlla che score sia un numero
    if (!is_numeric($score)) {
        die("Score non valido");
    }
    $stanza = $_SESSION["gioco"]["stanza"];
    $user = $_SESSION["username"];

    $server = "localhost";
    $conn = new mysqli($server, "root", "", "kingame");
    echo $score;
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Usa una query preparata per evitare SQL injection
    $sql = $conn->prepare("UPDATE sessione SET punteggio = ? WHERE User = ? AND Stanza = ?");
    $sql->bind_param("iss", $score, $user, $stanza); // Assumiamo che user e stanza siano stringhe

    if ($sql->execute()) {
        echo "Punteggio aggiornato con successo!";
    } else {
        echo "Errore nell'aggiornamento del punteggio: " . $conn->error;
    }

    $sql->close();
    $conn->close();
} else {
    echo "Score non ricevuto.";
}

$_SESSION["gioco"]["isFinished"]=true;

?>

<?php
// Includi il file di connessione al database
require_once 'db_connect.php'; // Connessione al database tramite db_connect.php

// $conn dovrebbe essere disponibile da db_connect.php
// La verifica della connessione è gestita all'interno di db_connect.php

header('Content-Type: application/json'); // Imposta l'header per la risposta JSON

$username = isset($_GET["username"]) ? $_GET["username"] : null;
$data = []; // Inizializza l'array dei dati

if ($username === null) {
    // Se lo username non è fornito, restituisci un errore o un array vuoto
    // A seconda di come vuoi gestire questo caso
    $data['error'] = "Username non fornito.";
    echo json_encode($data);
    exit; // Termina lo script
}

// Prepara lo statement per prevenire SQL injection e usa alias per le funzioni aggregate
// Aggiunto GROUP BY per correttezza, anche se WHERE UserName = ? limita a un utente
$sql = "SELECT
            utenti.NickName,
            utenti.UserName,
            utenti.Data_registrazione,
            utenti.img_profile,
            COUNT(sessione.User) AS NumGiochi,
            SUM(sessione.Punteggio) AS TotPunteggio,
            utenti.email,
            nazioni.Nome_Nazione
        FROM utenti
        LEFT JOIN sessione ON utenti.UserName = sessione.User
        LEFT JOIN nazioni ON nazioni.ISO = utenti.ISO
        WHERE utenti.UserName = ?
        GROUP BY
            utenti.NickName,
            utenti.UserName,
            utenti.Data_registrazione,
            utenti.img_profile,
            utenti.email,
            nazioni.Nome_Nazione";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $username); // Lega il parametro username
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data['nickname'] = $row["NickName"];
        $data['username'] = $row["UserName"];
        $data['data_reg'] = $row["Data_registrazione"];
        $data['img_profilo'] = $row["img_profile"];
        $data['n_giochi'] = $row["NumGiochi"];      // Usa l'alias corretto
        $data['punteggio'] = $row["TotPunteggio"]; // Usa l'alias corretto
        $data['email'] = $row["email"];
        $data['nazione'] = $row["Nome_Nazione"];
    } else {
        // Utente non trovato
        $data['error'] = "Utente non trovato";
    }
    $stmt->close();
} else {
    // Errore nella preparazione dello statement
    // In un'applicazione reale, logga questo errore invece di (o oltre a) inviarlo al client
    // error_log("Errore nella preparazione della query (getUteneData.php): " . $conn->error);
    $data['error'] = "Errore nel recupero dei dati utente: " . $conn->error;
}

echo json_encode($data);
$conn->close();
?>
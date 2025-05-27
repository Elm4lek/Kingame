<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require_once '../../db_connect.php';
    $stmt = $conn->prepare("SELECT nome.ENG as nome, pm_oggetti.Tipo AS tipo, pm_oggetti.Livello AS livello, pm_oggetti.Prezzo AS prezzo, descrizione.ENG AS descrizione
                            FROM pm_oggetti 
                            INNER JOIN testi nome ON nome.name = pm_oggetti.Nome
                            INNER JOIN testi descrizione ON descrizione.name = pm_oggetti.Descrizione
                            WHERE ID = '".$username."';");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows >0) {
        $row = $result->fetch_assoc();
        $shop[] = $row;
    }
    $conn->close();
?>
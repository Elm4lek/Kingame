<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $stanza = $_GET["stanza"];
    
    require_once '../../db_connect.php';
    $username = $_SESSION["username"];
    $stmt = $conn->prepare("SELECT * FROM tristris WHERE stanza=".$stanza.";");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data[] = [
            'giocatore' => $row["giocatore"],
            'x' => $row["x"],
            'y' => $row["y"]
        ];
    }
    echo json_encode($data);
    $conn->close();
?>
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $stanza = $_GET["stanza"];
    
    $conn = mysqli_connect("localhost","root","","kingame") or die (mysql_error());

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT * FROM tristris WHERE stanza=".$stanza.";");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $data[] = [
            'giocatore' => $row["giocatore"],
            'x' => $row["x"],
            'y' => $row["y"]
        ];
    }
    }
    echo json_encode($data);
    $conn->close();
?>
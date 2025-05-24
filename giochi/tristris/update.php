<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $json = file_get_contents('php://input');

    // Decodifica il JSON in un array associativo
    $post = json_decode($json, true);
    $stanza = $post["stanza"];
    $x = $post["x"];
    $y = $post["y"];
    
    $conn = mysqli_connect("localhost","root","","kingame") or die (mysql_error());

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
    $username = $_SESSION["username"];
    echo "INSERT INTO tristris(stanza,giocatore,x,y) VALUES(".$stanza.",'".$username."',".$x.",".$y.");";
    $stmt = $conn->prepare("INSERT INTO tristris(stanza,giocatore,x,y) VALUES(".$stanza.",'".$username."',".$x.",".$y.");");
    $stmt->execute();
    $stmt->get_result();

    $conn->close();
?>
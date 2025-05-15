<?php
    $stanza = $_GET["stanza"];
    $x = $_GET["x"];
    $y = $_GET["y"];
    
    $conn = mysqli_connect("localhost","root","","kingame") or die (mysql_error());

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
    $username = $_SESSION["username"];
    $stmt = $conn->prepare("INSERT INTO tristris(stanza,giocatore,x,y) VALUES(".$stanza.",'".$username."',".$x.",".$y.";");
    $stmt->execute();
    $stmt->get_result();

    $conn->close();
?>
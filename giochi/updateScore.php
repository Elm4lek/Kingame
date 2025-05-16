<?php
$score = $_POST["score"];

$stanza = $_SESSION["gioco"]["stanza"];
$user = $_SESSION["username"];

$server = "localhost";
$conn = new mysqli($server,"root","","kingame")  or die (mysql_error());

$sql = "INSERT INTO sessione(punteggio) VALUES(".$score.") WHERE User = ".$user." AND Stanza = ".$stanza.""; 
$conn->query($sql);

$conn->close();
?>
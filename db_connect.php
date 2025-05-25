<?php
$db_servername = "localhost";
$db_username = "root";
$db_password = ""; 
$dbname = "kingame";


$conn = new mysqli($db_servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>
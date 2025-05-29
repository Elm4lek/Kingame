<?php
require_once "config.php";

$db_servername = host;
$db_username = "root";
$db_password = ""; 
$dbname = "kingame";


$conn = new mysqli("localhost", $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$tipo = "crea";
$giocoNome = $_SESSION["gioco"]["gioco"];
$username = $_SESSION["username"];
$numero = $_SESSION['gioco']['numero'];
unset($_SESSION["gioco"]);
$server = "localhost";
$conn = new mysqli($server,"root","","kingame")  or die (mysql_error());

$sql = "SELECT Id FROM giochi WHERE Nome = '".$giocoNome."'"; 
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // oppure fetch_row() se preferisci un array numerico
    $gioco = $row["Id"];
}
echo json_encode([
    "tipo"=>$tipo,
    "gioco"=>$gioco,
    "username"=>$username,
    "numero"=>$numero]);
$conn->close();
?>
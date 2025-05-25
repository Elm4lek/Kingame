<?php
header("Access-Control-Allow-Origin: *");
$stanza = $_GET["stanza"];
require_once '../db_connect.php';

$sql = "SELECT  sessione.User,img_profile
        FROM stanze INNER JOIN sessione on sessione.Stanza = stanze.Id INNER JOIN utenti on sessione.user = utenti.UserName
        WHERE stanze.Id = ".$stanza." ;";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "userName" => $row["User"],
            "img" => $row["img_profile"],
        );
    }
}
$_SESSION["gioco"]["giocatori"] = $data;
echo json_encode($data);
$conn->close();
?>
<?php
require_once __DIR__ . '/../db_connect.php';

$sql = "SELECT stanze.Id as id_stanza, giochi.ID as nome_gioco, numero_giocatori, count(*) as giocatori_presenti
        FROM stanze INNER JOIN giochi ON stanze.Gioco = giochi.ID INNER JOIN sessione on sessione.Stanza = stanze.Id
        WHERE stanze.Stato = 0 GROUP BY stanze.Id ;";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "stanza" => (int)$row["id_stanza"],
            "gioco" => $row["nome_gioco"],
            "giocatore" => (int)$row["numero_giocatori"],
            "numero" => (int)$row["giocatori_presenti"],
        );
    }
}
if(empty($data)){
    echo "[]";
}
else{
    echo json_encode($data);
}
$conn->close();
?>
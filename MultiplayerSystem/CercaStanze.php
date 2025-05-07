<?php

$server = "localhost";
$conn = new mysqli($server,"root","","kingame")  or die (mysql_error());

$sql = "SELECT stanze.Id as id_stanza, giochi.Nome as nome_gioco, numero_giocatori, count(*) as giocatori_presenti 
        FROM stanze INNER JOIN giochi ON stanze.Gioco = giochi.ID INNER JOIN sessione on sessione.Stanza = stanze.Id 
        WHERE stanze.Stato = 0 GROUP BY stanze.Id HAVING giocatori_presenti < numero_giocatori;"; 
$result = $conn->query($sql);

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
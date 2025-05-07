<?php
$giocatore = $_GET["giocatore"];
$stanza = $_GET["stanza"];

$conn = new mysqli('localhost','root','', 'kingame');
$sql = "DELETE FROM `sessione` WHERE `sessione`.`User` = '".$giocatore."' AND `sessione`.`Stanza` = ".$stanza.";";
$result = $conn->query($sql);

$sql = "SELECT COUNT(*) FROM `sessione` GROUP BY `sessione`.`Stanza` HAVING `sessione`.`Stanza` = ".$stanza.";";
$result = $conn->query($sql);
echo $result->num_rows;
if ($result->num_rows == 0){
    echo " is deleting";
    $sql = "DELETE FROM stanze WHERE Id = ".$stanza.";";
    $result = $conn->query($sql);
}
?>
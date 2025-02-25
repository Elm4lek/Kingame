<?php

$conn = new mysqli('localhost','root','', 'dati');

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$stmt = $conn->prepare("");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo ": " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      $nickname = $row["NickNmae"];
      $username = $row["UserName"]
      $data_reg = $row["Data_registrazione"];
      $n_giochi = $row[""];
      $punteggio = $row["Punteggio"];


    }
  } else {
    echo "0 results";
  }
  $conn->close();

?>
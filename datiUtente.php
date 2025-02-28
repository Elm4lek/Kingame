<?php
session_start();
$conn = mysqli_connect("localhost","root","","kingame") or die (mysql_error());

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT NickName, UserName, Data_registrazione, COUNT(User), SUM(Punteggio) FROM utenti INNER JOIN sessione ON UserName = User WHERE UserName = 'Elmalek';");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $_SESSION['nickname'] = $row["NickName"];
        $_SESSION['username'] = $row["UserName"];
        $_SESSION['data_reg'] = $row["Data_registrazione"];
        $_SESSION['n_giochi'] = $row["COUNT(User)"];
        $_SESSION['punteggio'] = $row["SUM(Punteggio)"];
        
    }
} else {
    echo "utente non trovato";
}

$conn->close();
?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};
$conn = mysqli_connect("localhost","root","","kingame") or die (mysql_error());

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
$username = $_SESSION["username"];
$stmt = $conn->prepare("SELECT NickName, UserName, Data_registrazione, img_profile,COUNT(User), SUM(Punteggio), email, ISO FROM utenti LEFT JOIN sessione ON UserName = User WHERE UserName = '".$username."';");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['nickname'] = $row["NickName"];
    $_SESSION['username'] = $row["UserName"];
    $_SESSION['data_reg'] = $row["Data_registrazione"];
    $_SESSION['img_profilo'] = $row["img_profile"];
    $_SESSION['n_giochi'] = $row["COUNT(User)"];
    $_SESSION['punteggio'] = $row["SUM(Punteggio)"];
    $_SESSION['email'] = $row["email"];
    $_SESSION['ISO'] = $row["ISO"];
} else {
    echo "Utente non trovato";
}
$conn->close();
?>

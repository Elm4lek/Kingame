<?php
$conn = mysqli_connect("localhost","root","","kingame") or die (mysql_error());

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
$username = $_GET["username"];
$stmt = $conn->prepare("SELECT NickName, UserName, Data_registrazione, img_profile,COUNT(User), SUM(Punteggio), email, Nome_Nazione FROM utenti LEFT JOIN sessione ON UserName = User LEFT JOIN nazioni ON nazioni.ISO = utenti.ISO WHERE UserName = '".$username."';");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['nickname'] = $row["NickName"];
    $data['username'] = $row["UserName"];
    $data['data_reg'] = $row["Data_registrazione"];
    $data['img_profilo'] = $row["img_profile"];
    $data['n_giochi'] = $row["COUNT(User)"];
    $data['punteggio'] = $row["SUM(Punteggio)"];
    $data['email'] = $row["email"];
    $data['nazione'] = $row["Nome_Nazione"];
} else {
    echo "Utente non trovato";
}
echo json_encode($data);
$conn->close();
?>

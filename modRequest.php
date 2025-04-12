<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
};

$conn = new mysqli('localhost','root','', 'Kingame');

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$newNickname = $_POST['nome'];
$newEmail = $_POST['email'];
$newPwd = $_POST['password'];
$newFoto = $_POST['foto'];

$username = $_SESSION["username"];


echo "UPDATE utenti SET NickName = ".$newNickname.", Email = ".$newEmail.", Password = ".$newPwd.", img_profile = ".$newFoto." WHERE UserName = '".$username."';";
$stmt = $conn->prepare("UPDATE utenti SET NickName = ".$newNickname.", Email = ".$newEmail.", Password = ".$newPwd.", img_profile = ".$newFoto." WHERE UserName = '".$username."';");
if ($stmt->execute()) {
} else {
    echo "Errore: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo modificato</title>
    <link rel="stylesheet" href="css/regRiquest.css">
</head>
<body>

    <div class="container">
        <h1>Profilo modificato</h1>
        
        <div class="message">Profilo modificato con successo!</div>

        <form action='index.php'>
            <button class="btn-home" type="submit">Torna alla Home</button>
        </form>

    </div>

</body>
</html>
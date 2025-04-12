<?php
$conn = new mysqli('localhost','root','', 'kingame');

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$username = $_POST['username'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$password = $_POST['password'];
$paese = $_POST['paese'];

$conn = new mysqli('localhost','root','', 'kingame');

$sql = "INSERT INTO utenti (UserName, NickName, Email, Password, ISO,Data_registrazione) VALUES ('".$username."','".$nickname."', '".$email."', '".$password."', '".$paese."','".date("Y-m-d")."')";

$conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione Completata</title>
    <link rel="stylesheet" href="css/regRiquest.css">
</head>
<body>

    <div class="container">
        <h1>Registrazione Completata</h1>
        
        <div class="message">Registrazione effettuata con successo!</div>

        <form action='index.php'>
            <button class="btn-home" type="submit">Torna alla Home</button>
        </form>

    </div>

</body>
</html>
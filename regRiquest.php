<?php
$conn = new mysqli('localhost','root','', 'dati');

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$password = $_POST['password'];
$secPassword = md5($password);

$stmt = $conn->prepare("INSERT INTO utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nome, $cognome, $email, $secPassword);

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

        <div class="footer">elmalek</div>
    </div>

</body>
</html>
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
$foto_profilo = $_POST['foto'];

$sql = "INSERT INTO utenti (UserName, NickName, Email, Password, ISO,Data_registrazione, img_profile) VALUES ('".$username."','".$nickname."', '".$email."', '".$password."', '".$paese."','".date("Y-m-d")."','".$foto_profilo."')";

$conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione Completata</title>
    <style>
        body {
            font-family: 'Gochi Hand', cursive;
            background: #38223f;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .registration-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #4CAF50;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .message {
            color: #4CAF50;
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .home-button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .home-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="registration-container">
        <h1>Benvenuto!</h1>
        <p class="message">Registrazione effettuata con successo 🎉</p>
        <form action="index.php">
            <button type="submit" class="home-button">Torna alla Home</button>
        </form>
    </div>

</body>
</html>
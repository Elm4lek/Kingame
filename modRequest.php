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
$newPwd = MD5($_POST['password']);
$newFoto = $_POST['foto'];

$username = $_SESSION["username"];

$stmt = $conn->prepare("UPDATE utenti SET NickName = ?, Email = ?, Password = ?, img_profile = ? WHERE UserName = ?");

if ($stmt === false) {
    echo "Errore nella prepare: " . $conn->error;
    exit();
}

$stmt->bind_param("sssss", $newNickname, $newEmail, $newPwd, $newFoto, $username);

if ($stmt->execute()) {
    
} else {
    echo "Errore nell'execute: " . $stmt->error;
}
?>

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
$newPwd = MD5($_POST['password']);
$newFoto = $_POST['foto'];

$username = $_SESSION["username"];

$stmt = $conn->prepare("UPDATE utenti SET NickName = ?, Email = ?, Password = ?, img_profile = ? WHERE UserName = ?");

if ($stmt === false) {
    echo "Errore nella prepare: " . $conn->error;
    exit();
}

$stmt->bind_param("sssss", $newNickname, $newEmail, $newPwd, $newFoto, $username);

if ($stmt->execute()) {
    
} else {
    echo "Errore nell'execute: " . $stmt->error;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo modificato</title>
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
        .profile-update-container {
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

    <div class="profile-update-container">
        <h1>Profilo Modificato</h1>
        <p class="message">Il tuo profilo è stato aggiornato con successo! 🎉</p>
        <form action="index.php">
            <button type="submit" class="home-button">Torna alla Home</button>
        </form>
    </div>

</body>
</html>


<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'it';
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['it', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'];
include_once "lang/$lang.php";
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
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
        .logout-container {
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
        p {
            color: #4CAF50;
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .logout-button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h1>Arrivederci!</h1>
        <p>Sei stato disconnesso con successo. Torna a trovarci! 💚💚</p>
        <button class="logout-button" onclick="window.location.href='login.php'">Accedi di nuovo</button>
    </div>
</body>
</html>
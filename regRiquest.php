<?php
if (session_status() == PHP_SESSION_NONE) {
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
require_once 'db_connect.php';

$username = $_POST['username'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$password = $_POST['password'];
$paese = $_POST['paese'];
$foto_profilo = $_POST['foto'];

$sql = "INSERT INTO utenti (UserName, NickName, Email, Password, ISO, Data_registrazione, img_profile) 
        VALUES ('$username', '$nickname', '$email', '$password', '$paese', '" . date("Y-m-d") . "', '$foto_profilo')";

$conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $TEXT['registration_completed_title'] ?></title>
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
        <h1><?= $TEXT['registration_completed_heading'] ?></h1>
        <p class="message"><?= $TEXT['registration_completed_message'] ?></p>
        <form action="index.php">
            <button type="submit" class="home-button"><?= $TEXT['registration_back_home'] ?></button>
        </form>
    </div>

</body>
</html>
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

$update_successful = false;
$error_message = '';

if (isset($_SESSION["username"]) && isset($_POST['nome'], $_POST['email'], $_POST['password'], $_POST['foto'])) {
    $newNickname = $_POST['nome'];
    $newEmail = $_POST['email'];
    $newPwd = MD5($_POST['password']); 
    $newFoto = $_POST['foto'];
    $username = $_SESSION["username"];

    $stmt = $conn->prepare("UPDATE utenti SET NickName = ?, Email = ?, Password = ?, img_profile = ? WHERE UserName = ?");

    if ($stmt === false) {
        $error_message = "Errore nella preparazione della query: " . $conn->error;
    } else {
        $stmt->bind_param("sssss", $newNickname, $newEmail, $newPwd, $newFoto, $username);

        if ($stmt->execute()) {
            $update_successful = true;
            $_SESSION['nickname'] = $newNickname; 
            $_SESSION['img_profilo'] = $newFoto; 
            $_SESSION['email'] = $newEmail; 
        } else {
            $error_message = "Errore durante l'aggiornamento del profilo: " . $stmt->error;
            
        }
        $stmt->close();
    }
} else {
    $error_message = "Dati mancanti per l'aggiornamento del profilo o sessione non valida.";
}

$conn->close();


?>

<!DOCTYPE html>
<html lang="<?= $lang ?>"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $TEXT['profile_updated_title'] ?? 'Profilo Modificato' ?></title>
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
        .error-heading { 
             color: #D8000C; 
        }
        .message {
            color: #333; 
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
            text-decoration: none;
            display: inline-block; 
        }
        .home-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="profile-update-container">
        <?php if ($update_successful): ?>
            <h1><?= $TEXT['profile_updated_success_heading'] ?? 'Profilo Modificato' ?></h1>
            <p class="message"><?= $TEXT['profile_updated_success_message'] ?? 'Il tuo profilo è stato aggiornato con successo! 🎉' ?></p>
            <form action="index.php" method="get"> <button type="submit" class="home-button"><?= $TEXT['registration_back_home'] ?? 'Torna alla Home' ?></button>
            </form>
        <?php else: ?>
            <h1 class="error-heading"><?= $TEXT['profile_updated_error_heading'] ?? 'Errore Aggiornamento' ?></h1>
            <p class="message"><?= htmlspecialchars($error_message ?: ($TEXT['profile_updated_error_generic'] ?? 'Si è verificato un errore durante l\'aggiornamento del profilo.')) ?></p>
            <form action="modifica.php" method="get"> <button type="submit" class="home-button"><?= $TEXT['registration_back_home'] ?? 'Torna alla Modifica' ?></button>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>
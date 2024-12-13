<?php
include 'menu.php'; 
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/logRiquest.css">
    <title>Benvenuto</title>
</head>
<body>
    <div class="container">
        <?php
        $conn = new mysqli('localhost','root','', 'dati');

        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        if (!empty($_POST['fname']) && !empty($_POST['fpassword'])) {
            $username = trim($_POST['fname']);
            $password = trim($_POST['fpassword']);
        } else {
            if (isset($_SESSION['fname']) && isset($_SESSION['fpassword'])) {
                $username = $_SESSION['fname'];
                $password = $_SESSION['fpassword'];
            } else {
                echo 'Sessione scaduta o non valida';
                exit;
            }
        }

        $stmt = $conn->prepare("SELECT password FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($dbSecPassword);
            $stmt->fetch();

            if (md5($password) === $dbSecPassword) {
                echo "<div class='welcome-message'>Benvenuto, $username!</div>";
                $_SESSION['fname'] = $username;
                $_SESSION['fpassword'] = $password;
            } else {
                echo "<div class='welcome-message'>Login Fallito</div>";
            }
        } else {
            echo "<div class='welcome-message'>Login Fallito</div>";
        }

        $stmt->close();
        $conn->close();
        ?>
        <button class="btn-home" onclick="window.location.href='gioco.php';">vai ai Giochi</button>
        <div class="footer">elmalek</div>
    </div>
</body>
</html>
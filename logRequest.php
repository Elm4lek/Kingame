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
        $conn = new mysqli('localhost','root','', 'kingame');

        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $nickname = trim($_POST['username']);
            $password = trim($_POST['password']);
        } else {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                $nickname = $_SESSION['username'];
                $password = $_SESSION['password'];
            } else {
                echo 'Sessione scaduta o non valida';
                exit;
            }
        }

        $stmt = $conn->prepare("SELECT password FROM utenti WHERE Username = ?");
        $stmt->bind_param("s", $nickname);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($dbSecPassword);
            $stmt->fetch();
            if (md5($password) === $dbSecPassword) {
                echo "<div class='welcome-message'>Benvenuto, $nickname!</div>";
                echo '<button class="btn-home" onclick="window.location.href=\'giochi.php\';">vai ai Giochi</button>';
                $_SESSION['username'] = $nickname;
                $_SESSION['password'] = $password;
            } else {
                echo "<div class='welcome-message'>Login Fallito</div>";
            }
            } else {
                echo "<div class='welcome-message'>Login Fallito</div>";
            }

        $stmt->close();
        $conn->close();
        $url = 'datiUtente.php';

        // use key 'http' even if you send the request to https://...
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
            ],
        ];

        $context = stream_context_create($options);
        ?>
        
    </div>
</body>
</html>
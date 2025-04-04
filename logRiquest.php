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

        if (!empty($_POST['fname']) && !empty($_POST['fpassword'])) {
            $nickname = trim($_POST['fname']);
            $password = trim($_POST['fpassword']);
        } else {
            if (isset($_SESSION['fname']) && isset($_SESSION['fpassword'])) {
                $nickname = $_SESSION['fname'];
                $password = $_SESSION['fpassword'];
            } else {
                echo 'Sessione scaduta o non valida';
                exit;
            }
        }

        $stmt = $conn->prepare("SELECT password FROM utenti WHERE NickName = ?");
        $stmt->bind_param("s", $nickname);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($dbSecPassword);
            $stmt->fetch();
            echo md5($password)."<br>";
            echo $dbSecPassword."<br>";
            if (md5($password) === $dbSecPassword) {
                echo "<div class='welcome-message'>Benvenuto, $nickname!</div>";
                echo '<button class="btn-home" onclick="window.location.href=\'giochi.php\';">vai ai Giochi</button>';
                $_SESSION['fname'] = $nickname;
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
        
    </div>
</body>
</html>
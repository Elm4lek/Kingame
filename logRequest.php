<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvenuto</title>
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
        .welcome-container {
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
        .welcome-message {
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

    <div class="welcome-container">
        <?php
        $conn = new mysqli('localhost', 'root', '', 'kingame');

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
                echo '<div class="welcome-message">Sessione scaduta o non valida</div>';
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
                echo '<form action="giochi.php">
                        <button class="home-button" type="submit">Vai ai Giochi</button>
                      </form>';
                $_SESSION['username'] = $nickname;
                $_SESSION['password'] = $password;
            } else {
                echo "<div class='welcome-message'>Login Fallito</div>";
                echo '<form action="login.php">
                        <button class="home-button" type="submit">Torna al Login</button>
                      </form>';
            }
        } else {
            echo "<div class='welcome-message'>Login Fallito</div>";
            echo '<form action="login.php">
                        <button class="home-button" type="submit">Torna al Login</button>
                      </form>';
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

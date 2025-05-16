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
include 'menu.php';
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<head>
  <style>
    .card {
      display: flex;
  flex-direction: column;
  width: 100%;
  max-width: 400px;
  background: #1e1e2f; /* Sfondo nero */
  backdrop-filter: blur(8px);
  border-radius: 12px;
  padding: 20px;
  align-items: center;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  color: white; /* Testo bianco */
  justify-self: anchor-center;
          }
    .card h2, 
    .card label {
            color: white; /* Colore delle etichette e del titolo in bianco */
    }
    .card input {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            background: white;
            color: black;
    }
    .card input[type="submit"] {
            background:#4caf50;
            color: white;
            border: none;
            cursor: pointer;
    }
  </style>
</head>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/navbar.css">
  <title>Login Page</title>
</head>
<body>
<div class="card">  
    <h2>Login</h2>
    <form method="POST" action="logRequest.php">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <input type="submit" value="Login">
    </form>
    Non hai un account? <a href="registrazione.php" class="home-link">Registrati</a>
</div>
</body>
</html>
<?php
include 'menu.php';
if (isset($_SESSION['fname'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/navbar.css">
  <title>Login Page</title>
</head>
<body>
  <div class="form-container">
    <h2>Login</h2>

    <form method="POST" action="logRiquest.php">
      <label for="username">Username</label>
      <input type="text" id="username" name="fname" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="fpassword" required>

      <input type="submit" value="Login">
    </form>

    Non hai un account? <a href="registrazione.php" class="home-link">Registrati</a>
  </div>

</body>
</html>
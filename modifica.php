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
  <title>Registrazione</title>
    <!-- Aggiungi il CSS di Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Aggiungi il JS di Select2 -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

</head>
<style>
  .form-container input[type="submit"]{
    margin-top: 15px;
  }
</style>
<body>

<div class="form-container">
  <h2>Modifica il tuo profilo</h2>

  <form method="POST" action="completaReg.php" id="registrationForm">
    <label for="name">NickName</label>
    <input type="text" id="name" name="nome" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <label for="paesi">Seleziona la tua foto profilo</label> 
    <select name="paese" id="paese">
      <option value="imag1" data-image="a.jpg">Opzione 1</option>
      <option value="imag2" data-image="b.png">Opzione 2</option>
      <option value="imag3" data-image="c.png">Opzione 3</option>
    </select>

    <input type="submit" value="Modifica" id="submitBtn" disabled>

    <a href="index.php" class="home-link">Torna alla Home</a>
  </form>
</div>
  
</body>
</html>

<script>
  $(document).ready(function() {
    $('#paese').select2({
      templateResult: function(data) {
        if (!data.id) { return data.text; }
        var $result = $('<span><img src="' + $(data.element).data('image') + '" style="width: 20px; height: 20px; margin-right: 10px;" />' + data.text + '</span>');
        return $result;
      }
    });
  });
</script>



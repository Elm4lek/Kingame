<?php
include 'menu.php';
if (!isset($_SESSION['fname'])) {
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
  <title>Modifica Profilo</title>
    <!-- Aggiungi il CSS di Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Aggiungi il JS di Select2 -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <style>
    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
        }
        body {
            background: linear-gradient(-45deg, #6c4675, #503459, #7d5a8c, #432f48);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
        }
    .form-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 400px;
        background: #1e1e2f; /* Sfondo nero */
        backdrop-filter: blur(8px);
        border-radius: 12px;
        padding: 20px;
        align-items: center;
        border: 2px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        color: white; /* Testo bianco */
    }
    .form-container h2, 
    .form-container label {
        color: white; /* Colore del titolo e delle etichette in bianco */
    }
    .form-container input, 
    .form-container select {
        width: 100%;
        padding: 8px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        background: white;
        color: black;
    }
    .form-container input[type="submit"] {
        color: white;
        border: none;
        cursor: pointer;
    }
  </style>
</head>
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

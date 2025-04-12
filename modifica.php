<?php
include 'menu.php';
if (!isset($_SESSION['username'])) {
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

    </select>

      <label for="paesi">Seleziona il tuo personaggio</label> 
      <select name="foto" id="foto">
      <option value="imag1" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/1.png">1</option>
      <option value="imag2" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/2.png">2</option>
      <option value="imag3" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/3.png">3</option>
      <option value="imag4" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/4.png">4</option>
      <option value="imag5" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/5.png">5</option>
      <option value="imag6" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/6.png">6</option>
      <option value="imag7" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/7.png">7</option>
      <option value="imag8" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/8.png">8</option>
      <option value="imag9" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/9.png">9</option>
      <option value="imag10" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/10.png">10</option>
      <option value="imag11" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/11.png">11</option>
      <option value="imag12" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/12.png">12</option>
      <option value="imag13" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/13.png">13</option>
      <option value="imag14" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/14.png">14</option>
      <option value="imag15" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/15.png">15</option>
      <option value="imag16" data-image="https://raw.githubusercontent.com/Elm4lek/kingame_img/refs/heads/main/img_profilo/16.png">16</option>
      </select>

    <input type="submit" value="Modifica" id="submitBtn" disabled>

    <a href="index.php" class="home-link">Torna alla Home</a>
  </form>
</div>
  
</body>
</html>

<script>
  $(document).ready(function() {
    $('#foto').select2({
      templateResult: function(data) {
        if (!data.id) { return data.text; }
        var $result = $('<span><img src="' + $(data.element).data('image') + '" style="width: 100px; height: 100px; margin-right: 10px;" />' + data.text + '</span>');
        return $result;
      }
    });
  });
</script>

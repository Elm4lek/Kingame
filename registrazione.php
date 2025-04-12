<?php
$signUpPhase = 1;
$isOk = true;
include 'menu.php';
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if(isset($_POST) && !empty($_POST)){

  $conn = new mysqli('localhost','root','', 'kingame');

  $sql = "SELECT * FROM utenti WHERE UserName = '".$_POST['username']."'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0){
    $isOk = false;
  }

  if ($isOk) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $signUpPhase = 2;
  }
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/navbar.css">
  <title>Registrazione</title>
</head>
<body>
<?php
  if($signUpPhase == 1){
  echo '<div class="form-container">
      <h2>Registrazione</h2>

      <form method="POST" action="registrazione.php" id="registrationForm">
        
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>';
          if(!$isOk){
            echo "<p>username usato</p>";
          }

        echo '<label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="cpassword">Conferma Password</label>
        <input type="password" id="cpassword" name="cpassword" oninput="checkEquality()" required>

        <input type="submit" value="Registrati" id="submitBtn" disabled>

        <a href="index.php" class="home-link">Torna alla Home</a>
    </form>
    </div>';
  }
  else{
    
    $url = "data/States.json";
    $response = file_get_contents($url);
    $countries = json_decode($response, true);
    echo '
    <div class="form-container">
        <h2>Completa Registrazione</h2>

      <header>
          <!-- Aggiungi il CSS di Select2 -->
          <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

          <!-- Aggiungi il JS di Select2 -->
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
      </header>

        <form method="POST" action="regRiquest.php" id="registrationForm">
          <label for="name">Nome Utente</label>
          <input type="text" id="nome" name="nickname" required>
          
          <label for="paesi">Seleziona il tuo Paese</label>
          <select name="paese" id="paese">';
    
            foreach($countries as $country) {
                if ($country['cca2'] === 'IL') {
                    continue;
                }
                echo '<option value="';
                echo $country['cca2'];
                echo '">';
                echo $country['name']['common'];
                echo '</option>'; 
            }
      echo '
            <input type="hidden" name="username" value="'.$username.'">
            <input type="hidden" name="email" value="'.$email.'">
            <input type="hidden" name="password" value="'.md5($password).'">
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
          
          <input type="submit" value="Registrati" id="submitBtn">
       </form>
    </div>';
        
  }
  
?>
</body>
</html>

<script>
  function checkEquality() {
    const password = document.getElementById('password').value;
    const cpassword = document.getElementById('cpassword').value;
    const errorDiv = document.getElementById('passwordMismatch');

    if (password !== cpassword) {
      if (!errorDiv) {
        const newErrorDiv = document.createElement('div');
        newErrorDiv.id = 'passwordMismatch';
        newErrorDiv.style.color = 'red';
        newErrorDiv.textContent = 'Le password non coincidono';
        document.getElementById('cpassword').parentNode.insertBefore(newErrorDiv, document.getElementById('cpassword').nextSibling);
      }
    } else {
      if (errorDiv) {
        errorDiv.remove();
      }
    }
  }

  function validateForm() {
    const form = document.getElementById('registrationForm');
    const submitBtn = document.getElementById('submitBtn');
    const password = document.getElementById('password').value;
    const cpassword = document.getElementById('cpassword').value;

    // Controlla se tutti i campi obbligatori sono riempiti
    const allFieldsFilled = Array.from(form.elements).every((input) => {
      return input.value.trim() !== '' || !input.required;
    });

    // Abilita il pulsante solo se i campi sono pieni e le password coincidono
    submitBtn.disabled = !(allFieldsFilled && password === cpassword);
  }

  // Aggiungi event listener per tutti i campi di input
  document.querySelectorAll('input').forEach(input => {
    input.addEventListener('input', () => {
      validateForm();
    });
  });

  
  $(document).ready(function() {
    $('#foto').select2({
      templateResult: function(data) {
        if (!data.id) { return data.text; }
        var $result = $('<span><img src="' + $(data.element).data('image') + '" style="width: 140px; height: 140px; margin-right: 10px;" />' + data.text + '</span>');
        return $result;
      }
    });
  });
</script>

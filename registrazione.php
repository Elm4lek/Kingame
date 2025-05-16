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
$signUpPhase = 1;
$isOk = true;
$usernameError = "";
$emailError = "";
$passwordError = "";

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
    $usernameError = "Username già in uso.";
  }

  if ($isOk) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (strlen($password) < 10) {
      $isOk = false;
      $passwordError = "La password deve essere lunga almeno 10 caratteri.";
  }

    /* controllo se email esiste con mailboxlayer ( abbiamo solo 100 richieste al mese )*/
    /* $api_servizio = '450240d968ea204feb43a86ea8b0f6dc';  
    $email_encoded = urlencode($email);
    $mailboxlayer_url = "https://apilayer.net/api/check?access_key={$api_servizio}&email={$email_encoded}&smtp=1&format=1";

    $check_response = file_get_contents($mailboxlayer_url);
    $check_data = json_decode($check_response, true);

    if (!$check_data['format_valid'] || !$check_data['smtp_check']) {
        $isOk = false;
        $emailError = "Email non valida o inesistente.";
    } */
    /*------------------------------------------*/

    if ($isOk) {

    $signUpPhase = 2;
    }
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
        
        if (!empty($usernameError)) {
          echo "<p style='color:red;'>$usernameError</p>";
        }
      

        echo '<label for="email">Email</label>
        <input type="email" id="email" name="email" required>';

        if (!empty($emailError)) {
          echo "<p style='color:red;'>$emailError</p>";
        }

        echo '<label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="cpassword">Conferma Password</label>
        <input type="password" id="cpassword" name="cpassword" oninput="checkEquality()" required>';
        if (!empty($passwordError)) {
          echo "<p style='color:red;'>$passwordError</p>";
        }

        echo '<input type="submit" value="Registrati" id="submitBtn" disabled>

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
            <select name="foto" id="foto">';
            for ($i = 1; $i <= 16; $i++) {
                $img_url = "https://raw.githubusercontent.com/Elm4lek/kingame_img/main/img_profilo/{$i}.png";
                echo "<option value='$img_url' data-image='$img_url'>$i</option>";
            }
            echo '</select>
          
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

  function validatePasswordLength() {
    const password = document.getElementById('password').value;
    const passwordErrorDiv = document.getElementById('passwordLengthError');

    if (password.length < 10) {
        if (!passwordErrorDiv) {
            const newPasswordErrorDiv = document.createElement('div');
            newPasswordErrorDiv.id = 'passwordLengthError';
            newPasswordErrorDiv.style.color = 'red';
            newPasswordErrorDiv.textContent = 'La password deve essere lunga almeno 10 caratteri';
            document.getElementById('password').parentNode.insertBefore(newPasswordErrorDiv, document.getElementById('password').nextSibling);
        }
    } else {
        if (passwordErrorDiv) {
            passwordErrorDiv.remove();
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

    const passwordValid = password.length >= 10;

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

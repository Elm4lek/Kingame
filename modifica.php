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
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : 'N/A';
$foto_profilo = isset($_SESSION['img_profilo']) ? $_SESSION['img_profilo'] : 'N/A';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'N/A';

preg_match('/img_profilo\/(.*?)\.png/', $foto_profilo, $matches);

if (isset($matches[1])) {
    $foto = $matches[1];
}

$emailError = "";
$passwordError = "";

/* controllo se email esiste con mailboxlayer ( abbiamo solo 100 richieste al mese )*/
    /* $api_servizio = '450240d968ea204feb43a86ea8b0f6dc';  
    $email_encoded = urlencode($email);
    $mailboxlayer_url = "https://apilayer.net/api/check?access_key={$api_servizio}&email={$email_encoded}&smtp=1&format=1";

    $check_response = file_get_contents($mailboxlayer_url);
    $check_data = json_decode($check_response, true);

    if (!$check_data['format_valid'] || !$check_data['smtp_check']) {
        $emailError = "Email non valida o inesistente.";
    } */
    /*------------------------------------------*/
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

  <form method="POST" action="modRequest.php" id="modificaform">
    <label for="name">NickName</label>
    <input type="text" id="name" name="nome" value="<?php echo $nickname; ?>" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
    <?php 
    if (!empty($emailError)) {
          echo "<p style='color:red;'>$emailError</p>";
    }
    ?>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <?php 
    if (!empty($passwordError)) {
          echo "<p style='color:red;'>$passwordError</p>";
    }
    ?>
    

    <label for="paesi">Seleziona il tuo personaggio</label> 
      <select name="foto" id="foto" value="<?php echo $foto; ?>">
      <?php
        for ($i = 1; $i <= 16; $i++) {
            $img_url = "https://raw.githubusercontent.com/Elm4lek/kingame_img/main/img_profilo/{$i}.png";
            echo "<option value='$img_url' data-image='$img_url'>$i</option>";
        }
        ?>

    <input type="submit" value="Modifica" id="submitBtn">

    <a href="index.php" class="home-link">Torna alla Home</a>
  </form>
</div>
  
</body>
</html>

<script>


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
    const form = document.getElementById('modificaform');
    const submitBtn = document.getElementById('submitBtn');
    const password = document.getElementById('password').value;
    const cpassword = document.getElementById('email').value;

    // Controlla se tutti i campi obbligatori sono riempiti
    const allFieldsFilled = Array.from(form.elements).every((input) => {
      return input.value.trim() !== '' || !input.required;
    });

    const passwordValid = password.length >= 10;

    // Abilita il pulsante solo se i campi sono pieni e le password coincidono
    submitBtn.disabled = !(allFieldsFilled && passwordValid);
  }

  // Aggiungi event listener per tutti i campi di input
  document.querySelectorAll('input').forEach(input => {
    input.addEventListener('input', () => {
      validateForm();
      validatePasswordLength();
    });
  });



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

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
</script>

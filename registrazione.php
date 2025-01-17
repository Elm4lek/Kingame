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
 
</head>
<body>

 <div class="form-container">
    <h2>Registrazione</h2>

    <form method="POST" action="completaReg.php" id="registrationForm">
      <label for="name">Nome</label>
      <input type="text" id="name" name="nome" required>

      <label for="surname">Cognome</label>
      <input type="text" id="surname" name="cognome" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <label for="cpassword">Conferma Password</label>
      <input type="password" id="cpassword" name="cpassword" onchange="checkEquality('cpassword','password')" required>

      <input type="submit" value="Registrati" id="submitBtn" disabled>

      <a href="index.php" class="home-link">Torna alla Home</a>
   </form>
  </div>
  
</body>
</html>

<script>
  function checkEquality(now, og){
    var nowEl = document.getElementById(now);
    var ogEl = document.getElementById(og);
    var responseDiv = document.getElementById(og+'diverso');

    if (nowEl.value != ogEl.value) {
      if (!responseDiv) {
        responseDiv = document.createElement('div');
        responseDiv.id = og+'diverso';
        responseDiv.innerHTML = 'Password non uguale';
        nowEl.parentNode.insertBefore(responseDiv, nowEl.nextSibling);
      }
    } else {
      if (responseDiv) {
        responseDiv.remove();
      }
    }
    
    prosegui();
  }

  function prosegui() {
    const form = document.getElementById('registrationForm');
    const submitBtn = document.getElementById('submitBtn');
    
    //controlla se i campi sono pieni o no
    const pieno = Array.from(form.elements).every((input) => {
      return input.value.trim() !== '' || !input.required;
    });
    
    submitBtn.disabled = !pieno;
  }

  document.querySelectorAll('input').forEach(input => {
    input.addEventListener('input', validateForm);
  });
</script>
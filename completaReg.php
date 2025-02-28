<?php
include 'menu.php';

$json_url = "https://restcountries.com/v3.1/all";

$ch = curl_init($json_url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    die('Errore cURL: ' . curl_error($ch));
}

curl_close($ch);

$countries = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Errore nella decodifica JSON: ' . json_last_error_msg());
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Bandiere</title>
</head>
<body>


<div class="form-container">
        <h2>Completa Registrazione</h2>
    <form method="POST" action="completaReg.php" id="registrationForm">
      <label for="name">Nome Utente</label>
      <input type="text" id="nome" name="nickname" required>
      
      <label for="paesi">Seleziona il tuo Paese</label>
      <select name="paese" id="paese">
        <?php

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
        ?>
        <input type="hidden" name="nome" value="<?php echo $_POST['nome']; ?>">
        <input type="hidden" name="cognome" value="<?php echo $_POST['cognome']; ?>">
        <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
        <input type="hidden" name="password" value="<?php echo md5($_POST['password']); ?>">
      </select>

      <input type="submit" value="Registrati" id="submitBtn" disabled>
   </form>
</div>
    


        
    
</body>


</html>


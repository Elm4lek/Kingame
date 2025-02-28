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
    <style>
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
            color: white; /* Colore delle etichette e titolo in bianco */
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
                echo '<option value="' . $country['cca2'] . '">' . $country['name']['common'] . '</option>'; 
            }
            ?>
        </select>
        
        <input type="hidden" name="nome" value="<?php echo $_POST['nome']; ?>">
        <input type="hidden" name="cognome" value="<?php echo $_POST['cognome']; ?>">
        <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
        <input type="hidden" name="password" value="<?php echo md5($_POST['password']); ?>">
        
        <input type="submit" value="Registrati" id="submitBtn" disabled>
    </form>
</div>
    
</body>
</html>

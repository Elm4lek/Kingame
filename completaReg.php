<?php
include 'menu.php';
$json_url = "https://restcountries.com/v3.1/all";

$ch = curl_init($json_url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);

$countries = json_decode($response, true);
print_r($response);

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
    <div class="flag-container">
        <?php
        foreach ($countries as $country) {
            
            if (isset($country['cca2']) && isset($country['name']['common'])) {
                if ($country['cca2'] === 'IL') {
                    continue;
                }
                $flag_url = "https://flagcdn.com/w320/" . strtolower($country['cca2']) . ".png";
                echo '<div class="flag-item">';
                echo '<img src="' . $flag_url . '" alt="Bandiera di ' . htmlspecialchars($country['name']['common']) . '">';
                echo '<span>' . htmlspecialchars($country['name']['common']) . '</span>';
                echo '<span>' .'Pop: '. htmlspecialchars($country['population']) . '</span>';
                echo '</div>';
            }
        }
        ?>
    </div>


    <div class="form-container">
    <h2>Completa Registazione</h2>

    <label for="name">Nome Utente</label>
    <input type="text" id="nickname" name="nickname" required>

    <label for="surname">Prefisso paese</label>
    <input type="text" id="paese" name="paese" required>


    <input type="submit" value="Registrati" onclick = 'submit()'>

  </div>

    
</body>
</html>
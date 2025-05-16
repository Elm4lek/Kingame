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
/*if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}*/
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
<style>
    body{
        overflow: visible;
    }
.flag-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; 
    padding: 10px;
}

.flag-item {
    flex: 1 1 calc(25% - 20px); 
    box-sizing: border-box;
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}

.flag-item img {
    max-width: 100%;
    height: auto;
}
</style>
<body>
    <div class="flag-container">
        <?php
        foreach ($countries as $country) {
            if (isset($country['cca2']) && isset($country['name']['common'])) {
                if ($country['cca2'] === 'IL') {
                    continue;
                }
                $flag_url = "https://flagcdn.com/56x42/" . strtolower($country['cca2']) . ".png";
                echo '<div class="flag-item">';
                echo '<img src="' . $flag_url . '" alt="Bandiera di ' . htmlspecialchars($country['name']['common']) . '" onerror="this.style.display=\'none\'">';
                echo '<span>' . htmlspecialchars($country['name']['common']) . '</span>';
                echo '<span> - code: ' . htmlspecialchars($country['cca2']) . '</span>';
                echo '</div>';
            }
        }
        ?>

    </div>

        
    
</body>


</html>

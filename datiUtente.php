<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
};
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
$username = $_SESSION["username"];

    // Escape the SQL query properly or use prepared statements (see notes below)
    $sql = "SELECT NickName, UserName, Data_registrazione, img_profile, COUNT(User), SUM(Punteggio), email, Nome_Nazione 
            FROM utenti 
            LEFT JOIN sessione ON UserName = User 
            LEFT JOIN nazioni ON nazioni.ISO = utenti.ISO 
            WHERE UserName = '$username'";

    // Use correct array syntax (note the comma, not a semicolon)
    $url = 'http://localhost/kingame/cossesioneDB.php?' . http_build_query([
        'sql' => $sql
    ]);

    // Fetch response
    $response = file_get_contents($url);

    if ($response !== false) {
        $dati = json_decode($response, true);
        
        // Defensive check to ensure data was parsed
        if (is_array($dati)) {
            $_SESSION['nickname']     = $dati["NickName"] ?? '';
            $_SESSION['username']     = $dati["UserName"] ?? '';
            $_SESSION['data_reg']     = $dati["Data_registrazione"] ?? '';
            $_SESSION['img_profilo']  = $dati["img_profile"] ?? '';
            $_SESSION['n_giochi']     = $dati["COUNT(User)"] ?? 0;
            $_SESSION['punteggio']    = $dati["SUM(Punteggio)"] ?? 0;
            $_SESSION['email']        = $dati["email"] ?? '';
            $_SESSION['nazione']      = $dati["Nome_Nazione"] ?? '';
        } else {
            echo "Invalid JSON data received.";
        }
    } else {
        echo "Failed to retrieve data from cossesioneDB.php.";
    }
?>

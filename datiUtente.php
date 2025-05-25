<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'it';
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['it', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'];

$lang_file =   "/lang/$lang.php"; 
if (file_exists($lang_file)) {
    include_once $lang_file;
} else {
    if (file_exists(  "/lang/it.php")) {
        include_once   "/lang/it.php";
    }
}

if (isset($_SESSION["username"])) {
    require_once 'db_connect.php'; 


    $username_session = $_SESSION["username"];

    $sql = "SELECT
                utenti.NickName,
                utenti.UserName,
                utenti.Data_registrazione,
                utenti.img_profile,
                COUNT(sessione.User) AS NumGiochi,
                SUM(sessione.Punteggio) AS TotPunteggio,
                utenti.email,
                nazioni.Nome_Nazione
            FROM utenti
            LEFT JOIN sessione ON utenti.UserName = sessione.User
            LEFT JOIN nazioni ON nazioni.ISO = utenti.ISO
            WHERE utenti.UserName = ?
            GROUP BY
                utenti.NickName,
                utenti.UserName,
                utenti.Data_registrazione,
                utenti.img_profile,
                utenti.email,
                nazioni.Nome_Nazione";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username_session);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['nickname'] = $row["NickName"];
            $_SESSION['username'] = $row["UserName"];
            $_SESSION['data_reg'] = $row["Data_registrazione"];
            $_SESSION['img_profilo'] = $row["img_profile"];
            $_SESSION['n_giochi'] = $row["NumGiochi"];
            $_SESSION['punteggio'] = $row["TotPunteggio"];
            $_SESSION['email'] = $row["email"];
            $_SESSION['nazione'] = $row["Nome_Nazione"];
        } else {
            echo "Utente non trovato";
        }
        $stmt->close();
    }
}
?>
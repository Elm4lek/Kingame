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
$conn = new mysqli('localhost', 'root', '', 'kingame');

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'global';
$selectedCountry = isset($_GET['country']) ? $_GET['country'] : '';

// classifica globale
$query = "SELECT u.NickName, u.img_profile, SUM(s.Punteggio) AS punti, u.ISO
          FROM utenti u
          JOIN sessione s ON u.UserName = s.User
          GROUP BY u.UserName
          ORDER BY punti DESC";

if ($filter == 'nazione') {
    // classifica nazionale - AGGIUNTO ISO alla query
    $query = "SELECT nazioni.Nome_Nazione, nazioni.ISO, SUM(sessione.Punteggio) AS punti 
              FROM nazioni 
              LEFT JOIN utenti ON nazioni.ISO = utenti.ISO 
              LEFT JOIN sessione ON utenti.UserName = sessione.User 
              GROUP BY nazioni.Nome_Nazione, nazioni.ISO
              ORDER BY punti DESC";
} elseif ($filter == 'locale' && $selectedCountry != '') {
    // classifica locale
    $query = "SELECT u.NickName, u.img_profile, SUM(s.Punteggio) AS punti, u.ISO
              FROM utenti u
              JOIN sessione s ON u.UserName = s.User
              WHERE u.ISO = '$selectedCountry'
              GROUP BY u.UserName
              ORDER BY punti DESC";
}

$result = $conn->query($query);
$countryResult = $conn->query("SELECT ISO, Nome_Nazione FROM nazioni ORDER BY Nome_Nazione ASC");

if (!$result) {
    die("Errore nella query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifica | Kingame</title>
    <link rel="stylesheet" href="css/classifica.css">
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="ranking-container">
        <header class="ranking-header">
            <h1><span>🏆</span> Classifica Giocatori</h1>
            
            <form method="GET" action="" class="filter-form">
                <div class="filter-group">
                    <label for="filter">Visualizza:</label>
                    <select name="filter" id="filter" onchange="this.form.submit()">
                        <option value="global" <?= $filter == 'global' ? 'selected' : '' ?>>Classifica Globale</option>
                        <option value="nazione" <?= $filter == 'nazione' ? 'selected' : '' ?>>Per Nazione</option>
                        <option value="locale" <?= $filter == 'locale' ? 'selected' : '' ?>>Classifica Locale</option>
                    </select>
                </div>

                <?php if ($filter == 'locale'): ?>
                <div class="filter-group">
                    <label for="country">Paese:</label>
                    <select name="country" id="country" onchange="this.form.submit()">
                        <option value="">Tutti i Paesi</option>
                        <?php while ($country = $countryResult->fetch_assoc()): ?>
                            <option value="<?= $country['ISO'] ?>" <?= $selectedCountry == $country['ISO'] ? 'selected' : '' ?>>
                                <?= $country['Nome_Nazione'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <?php endif; ?>
            </form>
        </header>

        <main class="ranking-content">
            <table class="ranking-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th></th>
                        <th>Punti</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php $position = 1; ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <?php 
                            $name = $row['NickName'] ?? $row['Nome_Nazione'] ?? 'Anonimo';
                            $points = $row['punti'] ?? 0;
                            
                            // Gestione avatar/bandiera
                            if ($filter == 'nazione') {
                                $iso = strtolower($row['ISO'] ?? 'xx');
                                $avatar = "https://flagcdn.com/48x36/$iso.png";
                                $avatarClass = 'country-flag';
                            } else {
                                $avatar = $row['img_profile'] ?? 'img/default-avatar.png';
                                $avatarClass = 'player-avatar';
                            }
                            
                            $medal = $position <= 3 ? 'medal-' . $position : '';
                            ?>
                            
                            <tr class="<?= $medal ?>">
                                <td><?= $position ?></td>
                                <td><img src="<?= $avatar ?>" alt="<?= $name ?>" class="<?= $avatarClass ?>"></td>
                                <td><?= htmlspecialchars($name) ?></td>
                                <td><?= number_format($points) ?></td>
                            </tr>
                            
                            <?php $position++; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="no-data">Nessun dato disponibile</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>

<?php $conn->close(); ?>
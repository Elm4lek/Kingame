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
include_once "lang/$lang.php";
?>

<?php
$pageTitle = "Privacy Policy";
?>

<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/index.css">
</head>
<style>
    .footer-basic {
        margin-top:1000px;
    }
</style>
<body>
    <div class="container">
        <h1><?= $TEXT['privacy_policy_title'] ?></h1>

        <p><?= $TEXT['privacy_policy_paragraph1'] ?></p>

        <p><?= $TEXT['privacy_policy_paragraph2'] ?></p>

        <h3><?= $TEXT['privacy_policy_contact'] ?> <a href="mailto:kingames@GAMES.com">kingames@GAMES.com</a> <?= $TEXT['privacy_policy_authority'] ?></h3>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>

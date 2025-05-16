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
$pageTitle = "Termini e Condizioni";
?>

<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $TEXT['terms_and_conditions']; ?></h1>

        <h2>I. <?php echo $TEXT['identification_and_contact_info']; ?></h2>
        <p><?php echo $TEXT['terms_paragraph1']; ?></p>

        <h2>II. <?php echo $TEXT['nature_of_service']; ?></h2>
        <p><?php echo $TEXT['terms_paragraph2']; ?></p>

        <h2>III. <?php echo $TEXT['order_prices_payment_and_cancellation']; ?></h2>
        <p><?php echo $TEXT['terms_paragraph3']; ?></p>

        <h2>IV. <?php echo $TEXT['warranty_information']; ?></h2>
        <p><?php echo $TEXT['terms_paragraph4']; ?></p>

        <h2>V. <?php echo $TEXT['right_of_withdrawal']; ?></h2>
        <p><?php echo $TEXT['terms_paragraph5']; ?></p>

        <h2>VI. <?php echo $TEXT['safety_instructions']; ?></h2>
        <p><?php echo $TEXT['terms_paragraph6']; ?></p>

        <h2>VII. <?php echo $TEXT['contacts']; ?></h2>
        <p><?php echo $TEXT['terms_paragraph7']; ?></p>
    </div>
</body>
</html>

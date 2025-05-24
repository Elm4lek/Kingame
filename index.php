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
<?php include 'menu.php'; ?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="css/index.css">
    <title>Games</title>
</head>
<style>
.footer-basic {

  margin-top: 800px;
}
</style>

<body>
    <div class="container">
        <?php
        if(isset($_GET['lang']) && $_GET["lang"] == "flag"){
            echo "<h1>".$TEXT['get_flag01']."</h1>
                <h5><style>h5 { color: #ffffff; }</style>flag{Y0u_g07_7h3_f14g!}</h4>";
        }
        elseif(isset($_GET['lang']) && !in_array($_GET['lang'], ['it', 'en'])){
            echo "<h1>".$TEXT['wrong_flag01']."</h1>";
        }
        else{
            
            echo "<h1>".$TEXT['home1']."</h1>
                <h5>".$TEXT['home2']."</h5>
                <h4><style>h4 { color: #ffffff; }</style>".$TEXT['home3']."</h4>";
        }
        ?>
    </div>

</body>

<div class="bottom">
<?php include 'footer.php'; ?>
</div>
</html>

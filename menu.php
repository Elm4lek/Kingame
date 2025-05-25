<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION["username"])){
  include "datiUtente.php";
}

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'it';
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['it', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'];
include_once "lang/$lang.php";

require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="./logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
  body {
            background: linear-gradient(-45deg, #6c4675, #503459, #7d5a8c, #432f48);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            color: white;
            text-align: center;
            font-family: 'Gochi Hand', cursive;
        }
    .navbar-inverse {
        background-color: #330033;
    }
    .navbar-inverse .navbar-nav>li>a {
        color: #fff;
    }
    .navbar-inverse .navbar-nav>li>a:hover,
    .navbar-inverse .navbar-nav>li>a:focus {
        background-color: #1f1f2e;
    }

    
</style>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="http://<?= host ?>/kingame/index.php">KinGames</a>
    </div>
    <?php if (isset($_SESSION['username'])): ?>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="http://<?= host ?>/kingame/giochi.php"  style="font-family: 'Arial', cursive"><?= $TEXT['menu_giochi'] ?></a></li>
        <li><a href="http://<?= host ?>/kingame/classifica.php" style="font-family: 'Arial', cursive"><?= $TEXT['menu_classifica'] ?></a></li>
        <li><a href="http://<?= host ?>/kingame/chisiamo.php" style="font-family: 'Arial', cursive"><?= $TEXT['menu_chi_siamo'] ?></a></li>
      
    <li style="float: right;">
        <a href="?lang=<?= $_SESSION['lang'] === 'it' ? 'en' : 'it' ?>">
            <?= $TEXT['change_lang'] ?>
        </a>
    </li>
    
</ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true" style="padding: 5px;display: flex;align-items: center;">
        <p style="margin: 10px;"><?php echo $_SESSION["nickname"]?></p>
          <img src=<?php echo "'".$_SESSION["img_profilo"]."'"?> width="40" height="40" style="border-radius: 50%;">
        </a>
          <ul class="dropdown-menu">
              <li><a href="http://<?= host ?>/kingame/impostazione.php"><?= $TEXT['impostazione'] ?></a></li>
            <li><a href="http://<?= host ?>/kingame/logout.php">Logout</a></li>
          
    
</ul>
        </li>
      
    
</ul>
    </div>
    <?php else: ?>
      <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <li><a href="registrazione.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      
    <li style="float: right;">
        <a href="?lang=<?= $_SESSION['lang'] === 'it' ? 'en' : 'it' ?>">
            <?= $TEXT['change_lang'] ?>
        </a>
    </li>
    
</ul>
    </div>
    <?php endif; ?>
  </div>
</nav>

</body>

    


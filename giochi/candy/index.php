<?php
include '../../menu.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
/* if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
} */
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'it';
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['it', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'];
include_once "../../lang/$lang.php";
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Candy Crush Game</title>
  
  <link rel="icon" href="https://i.ibb.co/M6KTWnf/pic.jpg" />
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet" />

  <style>
    body {
      background: linear-gradient(90deg, #46756c, #34594c, #5a8c7d, #2f4843);
      background-size: 400% 400%;
      animation: gradientAnimation 10s ease infinite;
      margin: 0;
      font-family: 'Orbitron', sans-serif;
      color: #fff;
      overflow: hidden;
    }

    @keyframes gradientAnimation {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
    }

    .container {
      display: flex;
      flex-direction: column; /* Per impilare gli elementi verticalmente */
      align-items: center;   /* Per centrare gli elementi orizzontalmente */
      gap: 20px; /* Spazio tra la riga di gioco/punteggio e il pulsante di restart */
      padding: 20px;
      min-height: 100vh;
      box-sizing: border-box;
      padding-top: 30px; /* Ridotto un po' il padding top */
    }
    
    .game-top-row { /* Nuovo wrapper per scoreboard e area di gioco */
      display: flex;
      justify-content: center;
      align-items: flex-start; 
      gap: 40px;
      width: 100%; /* Occupa la larghezza per centrare il contenuto */
    }

    .scoreBoard {
      background-color: rgba(255, 255, 255, 0.05);
      border: 2px solid #00ffff;
      border-radius: 12px;
      padding: 20px 40px;
      text-align: center;
      justify-content: center;
      box-shadow: 0 0 15px #00ffff44;
      width: 300px;
      user-select: none;
    }

    .scoreBoard h3 { /* ... stili invariati ... */ }
    .scoreBoard h1 { /* ... stili invariati ... */ }
    #timer { /* ... stili invariati ... */ }

    .candy-crush-game-area-wrapper {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      border-radius: 8px;
      padding: 15px;
      box-sizing: border-box;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 0 20px #00ffff88 inset;
    }

    .grid {
      display: flex;
      flex-wrap: wrap;
      width: 630px; 
      height: 560px; 
      background-color: rgba(255, 255, 255, 0.05);
      border: 2px solid #00ffff;
      border-radius: 10px;
      box-shadow: 0 0 20px #00ffff55 inset;
      padding: 0; 
      user-select: none;
      position: relative; 
    }

    .grid div { /* Rimosso :not(#gameOverScreen) perché #gameOverScreen è stato eliminato */
      width: 70px;
      height: 70px;
      background-size: cover;
      background-position: center;
      border-radius: 5px;
      box-sizing: border-box; 
      transition: transform 0.2s ease;
      cursor: grab;
    }

    .grid div:hover { /* Rimosso :not(#gameOverScreen) */
      transform: scale(1.05);
      box-shadow: 0 0 10px #00ffffaa;
    }

    /* Stili per il pulsante Restart */
#restartButton {
  display: none;
  margin-top: 20px;
  padding: 15px 30px;
  font-size: 20px;
  font-family: 'Orbitron', sans-serif;
  color: #000;
  background-color: #ffeb3b;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  text-transform: uppercase;
  box-shadow: 0 4px 15px rgba(255, 235, 59, 0.5);
  transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
}


#restartButton:hover {
  background-color: #fdd835; /* Giallo leggermente più scuro */
  box-shadow: 0 6px 20px rgba(255, 213, 0, 0.6);
  transform: scale(1.05); /* Effetto ingrandimento al passaggio */
}
.score-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}


    /* Rimossi stili per #gameOverScreen */

  </style>
  <script type="text/javascript">
        const host = '<?= host // Assicurati che 'host' sia definito in menu.php ?>';
  </script>
</head>
<body>

<div class="container">
  <div class="game-top-row">
    <div class="score-wrapper">
        <div class="scoreBoard">
            <h3>Score</h3>
            <h1 id="score">0</h1>
            <div id="timer">Time Left: 02:00</div>
        </div>
        <button id="restartButton">RESTART</button>
    </div>


    <div class="candy-crush-game-area-wrapper">
      <div class="grid">
        </div>
    </div>
  </div>
  
  

</div>

<script src="script.js" charset="utf-8"></script>
</body>
</html>
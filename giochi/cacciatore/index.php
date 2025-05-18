<?php
include '../../menu.php';
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
include_once "../../lang/$lang.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cacciatore Game</title>
    <style>
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        body {
            background: linear-gradient(90deg, #46756c, #34594c, #5a8c7d, #2f4843);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            font-family: Arial, sans-serif;
        }
        #replayButton {
            background: #fbca1f;
            font-family: inherit;
            padding: 0.6em 1.3em;
            font-weight: 900;
            font-size: 18px;
            border: 3px solid black;
            border-radius: 0.4em;
            box-shadow: 0.1em 0.1em;
            margin: 20px auto;
            display: none;
        }
        #gameContainer {
            text-align: center;
        }
        #scoreDisplay {
            font-size: 24px;
            margin: 10px;
            color: white;
        }
    </style>
    <script type="text/javascript" src="js/mappa.js"></script>
    <script type="text/javascript" src="js/movimento.js"></script>
</head>
<body onload="inizializza(); initCacciatore();" onkeydown="checkKeyDown(event);" onkeypress="checkKeyPress(event)">
    <div id="gameContainer">
        <h1>ENERGIA: <span id="energia">0</span></h1>
        <div id="scoreDisplay">Punteggio: <span id="score">0</span></div>
        
        <div align="center">
            <div id="barra_sfondo" style="background-color: gray; width: 600px; margin: 10px">
                <div id="barra_tempo" style="background-color: green; width: 600px">.</div>
            </div>
        </div>

        <div align="center">
            <div id="piano">
                <?php
                for ($i = 0; $i < 10; $i++) {
                    for ($j = 0; $j < 20; $j++) {
                        echo "<img id=\"c{$i}_{$j}\" src=\"img1/0.jpg\" />";
                    }
                    echo "<br />\n";
                }
                ?>
            </div>
        </div>

        <p id="posizioneOmino"></p>
        <p id="messaggioDebug"></p>

        <button id="replayButton" onclick="replay()">Rigioca</button>
    </div>
</body>
</html>
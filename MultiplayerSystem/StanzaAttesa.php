<?php
session_start();
print_r($_SESSION);
$stanza = $_SESSION['gioco']['stanza'];
$nome = $_SESSION['gioco']['nome'];
$gioco = $_SESSION['gioco']['gioco'];
$numero = $_SESSION['gioco']['numero'];
$giocatore = $_SESSION['gioco']['giocatore'];
?>
<html>
    <head>
        <link rel="stylesheet" href="myStyle.css">
    </head>
    <body>

        <div class="main container">
            <?php
                
                echo '<div class="content testo" id="gioco">';
                echo 'gioco : '. $gioco;
                echo '</div>';
                echo '<div class="content testo-stanza" id="stanza">';
                echo 'CODICE STANZA : '. $stanza;
                echo '</div>';
                echo '<div class="content testo" id="giocatori">';
                echo 'giocatori restanti : '. $numero - sizeOf($giocatore);
                echo '</div>';
            ?>
        </div>

        <div class="content-bottom">

            <div class="esc-button" onclick="escCheck()"> ESC </div>
            <div class="player-container">
            <?php                
                for($i = 0; $i < sizeOf($giocatore); $i ++){
                    echo '<div class="player-img" id="'.$i.'">';
                    echo "<img src = '".$giocatore[$i]["img"]."'>";
                    echo '</div>';
                }
                for($i = 0; $i < $numero - sizeOf($giocatore); $i ++){
                    echo '<div class="player-img" id="'.$i.'">';
                    echo '<img src = "https://cdn.pixabay.com/animation/2022/07/29/03/42/03-42-05-37_512.gif">';
                    echo '</div>';
                }
            ?>
            </div>

        </div>

    </body>
</html>
<script>
window.addEventListener("unload", function () {
    console.log("User has left the page.");
    const data = JSON.stringify({ event: "page_unload", timestamp: 'something'});
    navigator.sendBeacon('prova.php', data);
});
</script>
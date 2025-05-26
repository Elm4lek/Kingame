<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};
require_once __DIR__ . '/../config.php';
$stanza = $_SESSION['gioco']['stanza'];
$nome = $_SESSION['nickname'];
$gioco = $_SESSION['gioco']['gioco'];
$numero = $_SESSION['gioco']['numero'];
$data = file_get_contents("http://".host."/kingame/MultiplayerSystem/CercaGiocatori.php?stanza=".$stanza);
$giocatore = json_decode($data);

?>
<html>
    <head>
        <link rel="stylesheet" href="myStyle.css">
        <head>
        <link rel="stylesheet" href="myStyle.css">
        <script type="text/javascript">
            const host = '<?= host ?>'; 
        </script>
</head>
    </head>
    <body>
        <?php echo "<input id='numero' type='hidden' value='".$numero."'>";?>
        <div class="main container" style="display: block">
            <?php
                echo '<div class="content testo">';
                echo 'gioco : <p id="gioco">'. $gioco.'</p>';
                echo '</div>';
                echo '<div class="content testo-stanza">';
                echo 'CODICE STANZA : <p id="stanza">'. $stanza.'</p>';
                echo '</div>';
                echo '<div class="content testo">';
                echo 'giocatori restanti : <p id="giocatori">'. $numero - sizeOf($giocatore).'</p>';
                echo '</div>';
            ?>
        </div>

        <div class="content-bottom">

            <div class="esc-button" onclick="escCheck()"> ESC </div>
            <div class="player-container">
            <?php                
                for($i = 0; $i < sizeOf($giocatore); $i ++){
                    echo '<div class="player-img" id="'.$i.'">';
                    echo "<img src = '".$giocatore[$i]->img."'>";
                    echo '</div>';
                }
                for($i = sizeOf($giocatore); $i < $numero ; $i ++){
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
    var elencoGiocatori = [];
    var numero;
    var stanza;
    async function fetchGiocatori() {
        elencoGiocatori.splice(0, elencoGiocatori.length);

        const response = await fetch("http://"+host+"/kingame/MultiplayerSystem/CercaGiocatori.php?stanza="+stanza);
        const risposta = await response.json();
        for (let i = 0; i < risposta.length; i++) {
            elencoGiocatori.push(risposta[i]);
        }
    }

    document.addEventListener("DOMContentLoaded", function(event) {
        
        numero = document.getElementById('numero').value;
        document.getElementById('numero').remove();
        stanza = document.getElementById('stanza').innerHTML;
        console.log("stanza:",stanza);
        isComplete();
        setInterval(() => {
            isComplete()
        }, 2500);
    });

    async function isComplete(){
        await fetchGiocatori();
        console.log(elencoGiocatori);
        if(elencoGiocatori.length == numero){
            document.location.href = "http://"+host+"/kingame/giochi/"+document.getElementById('gioco').innerHTML;
        }
        else{
            document.getElementById('giocatori').innerHTML = numero-elencoGiocatori.length;
            for(let i = 0; i < numero-elencoGiocatori.length; i++){
                let giocatore = document.getElementById(i.toString());
                let img = giocatore.getElementsByTagName("img")[0];
                img.src = elencoGiocatori[i].img;
            }
            for(let i = elencoGiocatori.length; i < numero; i++){
                let giocatore = document.getElementById(i.toString());
                let img = giocatore.getElementsByTagName("img")[0];
                img.src = "https://cdn.pixabay.com/animation/2022/07/29/03/42/03-42-05-37_512.gif";
            }

        }
    }

</script>
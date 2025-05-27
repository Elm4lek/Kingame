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
if(($numero - sizeOf($giocatore)) == 0){
    header("Location: http://".host."/kingame/giochi/".$gioco);
    exit;
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stanza Attesa - <?php echo htmlspecialchars($gioco); ?></title>
    <link rel="stylesheet" href="myStyle.css">
    <script type="text/javascript">
        const host = '<?= host ?>';
    </script>
    <style>
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        body {
            background: linear-gradient(-45deg, #6c4675, #503459, #7d5a8c, #432f48);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            font-family: Arial, Helvetica, sans-serif;
            color: #ffffff;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: calc(100vh - 40px);
            box-sizing: border-box;
        }
        .main.container {
            background-color: rgba(40, 25, 50, 0.7);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            text-align: center;
            width: 90%;
            max-width: 550px;
            margin-top: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(125, 90, 140, 0.5);
        }
        .content {
            margin-bottom: 18px;
            font-size: 1.1em;
            color: #e0e0e0;
        }
        .content:last-child {
            margin-bottom: 0;
        }
        .content.testo p,
        .content.testo-stanza p {
            display: inline-block;
            font-weight: bold;
            color: #ffffff;
            margin-left: 10px;
            background-color: rgba(0,0,0,0.2);
            padding: 3px 8px;
            border-radius: 4px;
        }
        .content.testo-stanza {
            font-size: 1.2em;
        }
        .content.testo-stanza p#stanza {
            color: #f3c22f;
            font-size: 1.25em;
            letter-spacing: 1px;
        }
        .content-bottom {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 700px;
        }
        .esc-button {
            background-color: #7d5a8c;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.05em;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-bottom: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .esc-button:hover,
        .esc-button:focus {
            background-color: #6c4675;
            transform: translateY(-2px);
            outline: none;
        }
        .player-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            gap: 15px;
            background-color: rgba(20, 10, 30, 0.6);
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            border: 1px solid rgba(125, 90, 140, 0.4);
        }
        .player-img {
            width: 90px;
            height: 90px;
            border: 2px solid #7d5a8c;
            border-radius: 50%;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .player-img:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(125, 90, 140, 0.7);
        }
        .player-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        p {
            margin-top: 0;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <?php echo "<input id='numero' type='hidden' value='".$numero."'>";?>
    <div class="main container" style="display: block">
        <?php
            echo '<div class="content testo">';
            echo 'Gioco : <p id="gioco">'. htmlspecialchars($gioco).'</p>';
            echo '</div>';
            echo '<div class="content testo-stanza">';
            echo 'CODICE STANZA : <p id="stanza">'. htmlspecialchars($stanza).'</p>';
            echo '</div>';
            echo '<div class="content testo">';
            echo 'Giocatori mancanti : <p id="giocatori">'. ($numero - count($giocatore)).'</p>'; 
            echo '</div>';
        ?>
    </div>

    <div class="content-bottom">
        <div class="esc-button" onclick="escCheck()"> ESCI </div>
        <div class="player-container">
        <?php
            $giocatoriAttuali = count($giocatore); // Usato count()
            for($i = 0; $i < $giocatoriAttuali; $i ++){
                echo '<div class="player-img" id="player-slot-'.$i.'">'; 
                echo "<img src = '".htmlspecialchars($giocatore[$i]->img)."' alt='Immagine giocatore ".($i+1)."'>";
                echo '</div>';
            }
            for($i = $giocatoriAttuali; $i < $numero ; $i ++){
                echo '<div class="player-img" id="player-slot-'.$i.'">'; 
                echo '<img src = "https://cdn.pixabay.com/animation/2022/07/29/03/42/03-42-05-37_512.gif" alt="Slot giocatore vuoto">';
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
        try {
            const response = await fetch("http://"+host+"/kingame/MultiplayerSystem/CercaGiocatori.php?stanza="+stanza);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const risposta = await response.json();
            for (let i = 0; i < risposta.length; i++) {
                elencoGiocatori.push(risposta[i]);
            }
        } catch (error) {
            console.error("Errore durante il fetch dei giocatori:", error);
        }
    }

    document.addEventListener("DOMContentLoaded", function(event) {
        numero = document.getElementById('numero').value;
        document.getElementById('numero').remove();
        stanza = document.getElementById('stanza').innerHTML;
        isComplete();
        setInterval(() => {
            isComplete();
        }, 2500);
    });

    async function isComplete(){
        await fetchGiocatori();
        const giocoElement = document.getElementById('gioco');
        if (!giocoElement) {
            console.error("Elemento 'gioco' non trovato.");
            return;
        }
        const nomeGioco = giocoElement.innerHTML;

        if(elencoGiocatori.length == numero){
            document.location.href = "http://"+host+"/kingame/giochi/"+nomeGioco;
        }
        else{
            const giocatoriMancantiElement = document.getElementById('giocatori');
            if (giocatoriMancantiElement) {
                giocatoriMancantiElement.innerHTML = numero - elencoGiocatori.length;
            }

            for(let i = 0; i < elencoGiocatori.length; i++){ 
                let giocatoreDiv = document.getElementById("player-slot-" + i); 
                if(giocatoreDiv){
                    let img = giocatoreDiv.getElementsByTagName("img")[0];
                    if(img && elencoGiocatori[i] && elencoGiocatori[i].img) {
                        img.src = elencoGiocatori[i].img;
                        img.alt = "Immagine giocatore " + (i+1);
                    }
                }
            }
            for(let i = elencoGiocatori.length; i < numero; i++){
                let giocatoreDiv = document.getElementById("player-slot-" + i); 
                 if(giocatoreDiv){
                    let img = giocatoreDiv.getElementsByTagName("img")[0];
                    if(img) {
                        img.src = "https://cdn.pixabay.com/animation/2022/07/29/03/42/03-42-05-37_512.gif";
                        img.alt = "Slot giocatore vuoto";
                    }
                }
            }
        }
    }
    function escCheck() {
        window.location.href = "http://"+host+"/kingame/giochi.php";
    }
</script>
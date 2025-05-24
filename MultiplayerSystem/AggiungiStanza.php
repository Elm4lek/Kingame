<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};
?>

<html>
<head>
<script type="text/javascript" src="AggiungiStanza.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="myStyle.css">
</head>
<body>
    <div class = 'container due-parti verticale grandezza-0'>
        <div class="top main container">
            <div class="content testo-stanza">INSERISCI COD STANZA: </div>
            <input type="text" id="inputStanza" name="inputStanza">
            <div id = "checkStanza"></div>
            <div id = "aggiungiButtonInsert"></div>
        </div>
        <div class="bottom main container">
            <select id="nomeGioco" onchange="selezionaGioco()" >
                <?php 
                $data = file_get_contents("http://localhost:8080/kingame/MultiplayerSystem/CercaStanze.php");
                echo "<option value='Tutto'>Tutto</option>";
                $stanze = json_decode($data);
                $games = [];
                foreach($stanze as $stanza){
                    if(!in_array($stanza->gioco,$games)){
                        echo "<option value=".$stanza->gioco." data-numero=".$stanza->numero." data-id=".$stanza->ID.">".$stanza->gioco."</option>";
                        array_push($games,$stanza->gioco);
                    }
                }
                ?>
            </select>
            <div id="Stanza"></div>
            <div id = "aggiungiButtonSelect"></div>
        </div>
        <input type="button" value="fetch" onclick="fetchStanze()"> 
    </div>
</body>
</html>

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
            <div class="content testo-stanza" id="stanza">INSERISCI COD STANZA: </div>
            <input type="text" id="inputStanza" name="inputStanza">
            <div id = "checkStanza"></div>
            <div id = "aggiungiButtonInsert"></div>
        </div>
        <div class="bottom main container">
            <select id="nomeGioco" onchange="selezionaGioco()" >
                <option value="Tutto">Tutto</option>
                <option value="TrisTris">TrisTris</option>
                <option value="Sasso-carta-forbice">Sasso-carta-forbice</option>
            </select>
            <div id="Stanza"></div>
            <div id = "aggiungiButtonSelect"></div>
        </div>
    </div>
</body>
</html>

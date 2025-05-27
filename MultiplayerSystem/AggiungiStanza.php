<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Stanza</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="AggiungiStanza.js" defer></script>
    <script>
        const host = '<?= host ?>';
    </script>

    <link rel="stylesheet" href="myStyle.css">
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
            color: #fff;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: calc(100vh - 40px);
            box-sizing: border-box;
        }

        .container.due-parti {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            gap: 20px;
        }

        .main.container {
            background-color: rgba(40, 25, 50, 0.75);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 90%;
            max-width: 500px;
            border: 1px solid rgba(125, 90, 140, 0.6);
        }

        .top.main.container,
        .bottom.main.container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .content.testo-stanza {
            font-size: 1.2em;
            color: #e0e0e0;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        select#codStanza {
            width: 80%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #7d5a8c;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 1em;
            box-sizing: border-box;
        }

        input[type="text"]::placeholder {
            color: #bbbbbb;
        }

        input[type="text"]:focus,
        select#codStanza:focus {
            outline: none;
            border-color: #f3c22f;
            box-shadow: 0 0 8px rgba(243, 194, 47, 0.5);
        }

        select#codStanza option {
            background-color: #503459;
            color: #fff;
        }

        #checkStanza {
            min-height: 20px;
            font-size: 0.95em;
            font-weight: bold;
            color: #f3c22f;
        }

        #aggiungiButtonInsert button,
        #aggiungiButtonSelect button,
        input[type="button"] {
            background-color: #7d5a8c;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            min-width: 150px;
        }

        #aggiungiButtonInsert button:hover,
        #aggiungiButtonSelect button:hover,
        input[type="button"]:hover {
            background-color: #6c4675;
            transform: translateY(-2px);
        }

        #aggiungiButtonInsert button:focus,
        #aggiungiButtonSelect button:focus,
        input[type="button"]:focus {
            outline: none;
        }

        #Stanza {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        input[type="button"] {
            margin-top: 20px;
        }

        input[type="button"][value="Aggiorna Elenco Stanze"] {
            padding: 15px 30px;
            font-size: 1.1em;
            min-width: 350px;
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
            margin-top: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .esc-button:hover,
        .esc-button:focus {
            background-color: #6c4675;
            transform: translateY(-2px);
            outline: none;
        }

        p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container due-parti verticale grandezza-0">
        <div class="top main container">
            <div class="content testo-stanza">INSERISCI COD STANZA:</div>
            <input type="text" id="inputStanza" name="inputStanza" placeholder="Es. 123">
            <div id="checkStanza"></div>
            <div id="aggiungiButtonInsert"></div>
        </div>

        <div class="bottom main container">
            <div class="content testo-stanza">OPPURE SELEZIONA UNA STANZA:</div>
            <div id="Stanza">
                <select id="codStanza" onchange="stanzaSelezionata()">
                    <option value="">Caricamento stanze...</option>
                </select>
            </div>
            <div id="aggiungiButtonSelect"></div>
            <input type="button" value="Aggiorna Elenco Stanze" onclick="fetchStanze()">
        </div>
    </div>

    <div class="esc-button" onclick="escCheck()">ESCI</div>

    <script>
        function escCheck() {
            window.location.href = "http://" + host + "/kingame/giochi.php";
        }
    </script>
</body>
</html>

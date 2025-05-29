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
<?php
include 'menu.php';
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>

<html lang="it">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $TEXT['game_title'] ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .centro {

        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 4px;

        }
        .mask{
            position: absolute;
            top: 0;
            left: 0;
            z-index: 99;
            height: 100%;
            width: 100%;
        }
        .mask-hovered {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: -99;
            background: black;
        }
        .tetris {
            background-image: url('Grafiche videogiochi/screenshot tetris.png');
            background-size: cover;
            background-position: center;
        }
        .tristris {
            background-image: url('Grafiche videogiochi/screenshotTrisTris.png');
            background-size: cover;
            background-position: center;
        }
        .cacciatore {
            background-image: url('Grafiche videogiochi/screenshotcacciatore.png');
            background-size: cover;
            background-position: center;
        }
        .snake {
            background-image: url('Grafiche videogiochi/snake.png');
            background-size: cover;
            background-position: center;
        }
        .candy {
            background-image: url('Grafiche videogiochi/candy.jpg');
            background-size: cover;
            background-position: center;
        }
        .contenitore:hover {
            transform: scale(1.1);
        }
        @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
        }

        body {
        background: linear-gradient(-45deg, #6c4675, #503459, #7d5a8c, #432f48);
        background-size: 400% 400%;
        animation: gradientAnimation 10s ease infinite;
        }
        .footer-basic {
            bottom: 0;
            margin-top: 500px;
        }

        .contenitore {
        position: relative;
        width: 200px;
        height: 200px;
        background-color: #fff; 
        border-radius: 20px;
        margin: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        cursor: pointer;
        display: flex;
        flex-direction: column; 
        justify-content: center;
        align-items: center; 
        overflow: hidden; 
        box-sizing: border-box;
        padding: 10px; 
    }

    .contenitore h3 {
        color: #333333;
        margin: 0 0 8px 0;      
        padding: 0 5px;          
        font-size: 1.15em;    
        font-weight: bold;
        text-align: center;
        position: relative;
        z-index: 10;
        line-height: 1.25; 
        max-width: 100%;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .contenitore form {
        display: flex; 
        flex-direction: column;
        align-items: center;
        margin-bottom: 6px; 
        width: 100%;           
        position: relative;
        z-index: 10;
    }

    .contenitore form:last-of-type {
        margin-bottom: 0;
    }

    .contenitore input[type='submit'] {
        background-color: #7d5a8c;
        color: white;
        border: none;
        padding: 8px 10px;       
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.85em;     
        font-weight: bold;
        transition: background-color 0.3s ease;
        width: 90%;          
        max-width: 160px;       
        box-sizing: border-box;
        text-align: center;
        line-height: 1.2;     
        white-space: normal;     
        word-break: break-word; 
        height: auto;            
    }

    .contenitore input[type='submit']:hover {
        background-color: #6c4675;
    }

    </style>
</head>
<body>
    <div class="centro">
        <?php
        require_once 'db_connect.php'; 

        $sql = "SELECT * FROM `giochi`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<div class='contenitore' data-name='".$row["Nome"]."'>
                        <h3>".$row["Nome"]."</h3>
                        <form method='POST' action='MultiplayerSystem/CreaStanza.php'>
                            <input type='hidden' name='tipo' value='crea'>
                            <input type='hidden' name='gioco' value='".$row["ID"]."'>
                            <input type='hidden' name='numero' value='".$row["Numero_Giocatori"]."'>
                            <input type='submit' value='".$TEXT['create']."'>
                        </form>";

                if (strtolower($row["Nome"]) === 'tristris') {
                    echo "<form method='POST' action='MultiplayerSystem/AggiungiStanza.php'>
                            <input type='submit' value='".$TEXT['add']."'>
                        </form>";
                }

                echo "<div class='".$row["Nome"]." mask'></div>
                    </div>";
            }
        }
        $conn->close();
    ?>
    </div>
<?php include 'footer.php'; ?>
<script>
    $(document).ready(function() {
    $('.contenitore').each(function() {
        console.log(this);
        if(this.dataset.name){
            this.addEventListener("mouseover", () => {
                const mask = this.querySelector('.mask');
                if (mask) {
                    mask.className = "mask-hovered";
                }
            });

            this.addEventListener("mouseout", () => {
                const mask = this.querySelector('.mask-hovered');
                if (mask) {
                    mask.className = this.dataset.name+" mask";
                }
            });
        }
    });
    });
</script>

</body>
</html>
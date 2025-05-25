<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};
include "../menu.php";

function getPositionalClass($i, $j) {
    $rows = ['north', 'center', 'south'];
    $cols = ['west', 'center', 'est'];

    return $rows[intdiv($i, 3)] . '-' . $cols[$i % 3];
}

function getCellClass($i, $j) {
    $rows = ['north', 'center', 'south'];
    $cols = ['west', 'center', 'est'];

    return $rows[intdiv($j, 3)] . '-' . $cols[$j % 3];
}
?>
<html>
    <head>
        <script type="text/javascript" src="js/myJs.js"></script>
        <script type="text/javascript">
            const host = '<?= host ?>';
        </script>
        <link rel="stylesheet" href="myCss.css">
        <style>
            html{
                font-family: "Lucida Console", "Courier New", monospace;
                font-size: 35px;
            }
            #commento{
                position: absolute;
                opacity: 0;
                z-index: -1;
            }
            .main-content {
                width: 40vw;
                height: 40vw;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                margin: auto;
                
                display: flex;
                flex-wrap: wrap;
            }
            .secondary-content{
                width: 32.5%;
                height: 33%;
            }
            .content {
                width: 80%;
                height: 80%;
                display: flex;
                flex-wrap: wrap;
                
                margin: 10%;
            }
            .cell{
                width: 32%;
                height: 33%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .north-west{
                border-right: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .north-center{
                border-left: 1px solid rgb(121, 119, 130);
                border-right: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .north-est{
                border-left: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .center-west{
                border-top: 1px solid rgb(121, 119, 130);
                border-right: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .center-center{
                border-top: 1px solid rgb(121, 119, 130);
                border-left: 1px solid rgb(121, 119, 130);
                border-right: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .center-est{
                border-top: 1px solid rgb(121, 119, 130);
                border-left: 1px solid rgb(121, 119, 130);
                border-bottom: 1px solid rgb(121, 119, 130);
            }
            .south-west{
                border-right: 1px solid rgb(121, 119, 130);
                border-top: 1px solid rgb(121, 119, 130);
            }
            .south-center{
                border-left: 1px solid rgb(121, 119, 130);
                border-right: 1px solid rgb(121, 119, 130);
                border-top: 1px solid rgb(121, 119, 130);
            }
            .south-est{
                border-left: 1px solid rgb(121, 119, 130);
                border-top: 1px solid rgb(121, 119, 130);
            }

            .north-west.secondary-content{
                border-right: 2px solid black;
                border-bottom: 2px solid black;
            }
            .north-center.secondary-content{
                border-left: 2px solid black;
                border-right: 2px solid black;
                border-bottom: 2px solid black;
            }
            .north-est.secondary-content{
                border-left: 2px solid black;
                border-bottom: 2px solid black;
            }
            .center-west.secondary-content{
                border-top: 2px solid black;
                border-right: 2px solid black;
                border-bottom: 2px solid black;
            }
            .center-center.secondary-content{
                border-top: 2px solid black;
                border-left: 2px solid black;
                border-right: 2px solid black;
                border-bottom: 2px solid black;
            }
            .center-est.secondary-content{
                border-top: 2px solid black;
                border-left: 2px solid black;
                border-bottom: 2px solid black;
            }
            .south-west.secondary-content{
                border-right: 2px solid black;
                border-top: 2px solid black;
            }
            .south-center.secondary-content{
                border-left: 2px solid black;
                border-right: 2px solid black;
                border-top: 2px solid black;
            }
            .south-est.secondary-content{
                border-left: 2px solid black;
                border-top: 2px solid black;
            }

            .vittoria{
                color: red
            }
            .nonSelezionato{
                background-color: #f3f3f3;
            }
            .vittoriaG1{
                background-color: lightblue;
            }
            .vittoriaG2{
                background-color: lightcoral;
            }

        </style>
    </head>
    <body>
        <?php
        echo '<input id="stanza" type="hidden" value="'.$_SESSION["gioco"]["stanza"].'">';
        echo '<input id="username" type="hidden" value="'.$_SESSION["username"].'">';
        echo '<input id="inizia" type="hidden" value="'.($_SESSION["gioco"]["giocatore"]==$_SESSION["username"]).'">';
        ?>
        <div id="main" class="main-content">        
            <?php
            for ($i = 0; $i < 9; $i++) {
                $secClass = getPositionalClass($i, $i); // posizioni diagonali (per usare solo $i è corretto)
                echo '<div id="'.$i.'" class="secondary-content '.$secClass.'">';
                echo '<div class="content">';
                for ($j = 0; $j < 9; $j++) {
                    $cellClass = getCellClass($i, $j);
                    echo '<div id="'.$i.'-'.$j.'" class="cell '.$cellClass.'"></div>';
                }
                echo '</div></div>';
            }
            ?>
        </div>
    </body>
</html>
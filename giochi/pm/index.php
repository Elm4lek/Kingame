<?php
include 'startGame.php';
?>
<html>
    <head>
        <script type="module" src="battle.js"></script>
        <link rel="stylesheet" href="myCss.css">
    </head>

    <body>
        <div id="content">
            <div class="dialog-box-background">
                <div class="dialog-box-border">
                    <div id="dialog-box" class="text-container">select a move</div>
                </div>
            </div>
        </div>
        <div id="choice-bar">
            <div id="choice1" class="choice text-container"> Fight </div>
            <div id="choice2" class="choice text-container"> Bag </div>
            <div id="choice3" class="choice text-container"> Pokemon</div>
            <div id="choice4" class="choice text-container"> Cancel </div>
        </div>

    </body>
</html>
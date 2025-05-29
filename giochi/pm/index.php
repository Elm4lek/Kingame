<?php
include 'startGame.php';
?>
<html>
<head>
    <link rel="stylesheet" href="myCss.css">
    <script type="module" src="main.js"></script>
</head>

<body>
    <input type="hidden" id="dati" data-userData='<?php echo json_encode($dati); ?>'>
    <script id="shop-data" type="application/json">
        <?= json_encode($shop, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
    </script>

    <div id="content">
        <div style="
        width: 100%;
        height: 75%;">
            
            
        </div>
    
        <div class="dialog-box-background">
            <div class="dialog-box-border">
                <div id="dialog-box" class="text-container">welcome!</div>
            </div>
        </div>
    </div>
    <div id="choice-bar">
        <div id="choice1" class="choice text-container" onclick="select('Fight')"> Fight </div>
        <div id="choice2" class="choice text-container" onclick="select('Shop')"> Shop </div>
        <div id="choice3" class="choice text-container" onclick="select('Pokemon')"> Pokemon</div>
        <div id="choice4" class="choice text-container" onclick="select('Adversary')"> Adversary </div>
    </div>

</body>
</html>
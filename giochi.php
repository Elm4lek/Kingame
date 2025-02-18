<?php
include 'menu.php';

    ?>
<!DOCTYPE html>

<html lang="it">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titoloPagina; ?></title>
    <style>
        .centro {
          
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
         gap: 4px;
            
        }
        .contenitoretetris {
            width: 200px;
            height: 200px;
            background-color: #fff;
            border-radius: 20px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background-image: url('img/tetrislogo.png');
            background-size: cover;
            background-position: center;
}

        .contenitore {
            width: 200px;
            height: 200px;
            background-color: #fff;
            border-radius: 20px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .contenitoretetris:hover {
            transform: scale(1.1);
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

    </style>
</head> 

<body>
    <div class="centro">
    <a href="tetris.php">
        <div class="contenitoretetris">
        </div>
    </a>
        <div class="contenitore"></div>
        <div class="contenitore"></div>
        
    </div>
    <div class="centro">
        <div class="contenitore"></div>
        <div class="contenitore"></div>
        
    </div>
<?php include 'footer.php'; ?>

</body>
</html>
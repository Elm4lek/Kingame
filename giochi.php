<?php
include 'menu.php';
/*if (!isset($_SESSION['fname'])) {
    header("Location: index.php");
    exit();
}*/
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

    <div class="bottom">
<?php include 'footer2.php'; ?>
</div>
</body>
</html>
<?php
include 'menu.php';
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $titoloPagina; ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>

        body {
            background: linear-gradient(-45deg, #6c4675, #503459, #7d5a8c, #432f48);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            color: white;
            text-align: center;
            font-family: 'Gochi Hand', cursive;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            gap: 50px;
        }

        .box {
            width: 250px;
            height: 250px;
            background-color: white;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.75);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .box:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    
    <div class="main-container">
        <div class="box">Chi siamo</div>
        <div class="box">Gioca</div>
    </div>
    <div class="bottom">
</body>
<?php include 'footer.php'; ?>
</html> 
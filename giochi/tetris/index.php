<?php
include 'menu.php';
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <style>
        @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
        }
        body {
            background: linear-gradient(90deg, #6c4675, #503459, #7d5a8c, #432f48);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
        }
        canvas {
            position: absolute;
            top: 45%;
            left: 50%;
            width: 640px;
            height: 640px;
            margin: -320px 0 0 -320px;
        }
    </style>
</head>

<body>
    <canvas>
        <script src="tetris.js"></script>
    </canvas>
</body>

</html>
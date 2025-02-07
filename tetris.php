<?php
include 'menu.php';
if (isset($_SESSION['fname'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <style>
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
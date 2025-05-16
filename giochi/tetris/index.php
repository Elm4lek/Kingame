<?php
include '../../menu.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
/* if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
} */

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'it';
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['it', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'];
include_once "../../lang/$lang.php";
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
<?php
if (session_status() == PHP_SESSION_NONE) {
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

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : 'N/A';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'N/A';
$data_reg = isset($_SESSION['data_reg']) ? $_SESSION['data_reg'] : 'N/A';
$foto_profilo = isset($_SESSION['img_profilo']) ? $_SESSION['img_profilo'] : 'N/A';
$n_giochi = isset($_SESSION['n_giochi']) ? $_SESSION['n_giochi'] : 0;
$punteggio = isset($_SESSION['punteggio']) ? $_SESSION['punteggio'] : 0;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'N/A';
$nazione = isset($_SESSION['nazione']) ? $_SESSION['nazione'] : 'N/A';
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $TEXT['profile_title'] ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJ6H4L6gkR6mef1Pf4hzRfEXM04Cw9TAsii9FsZ0uSks8W5s7DFAaa7QK8YF" crossorigin="anonymous">
    
    <style>
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

        .container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .card {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 1200px;
            background: #1e1e2f;
            backdrop-filter: blur(8px);
            border-radius: 12px;
            padding: 20px;
            align-items: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .card-header .left-section {
            display: flex;
            align-items: center;
        }

        .card img {
            width: 180px;
            height: 180px;
            border-radius: 12px;
            margin-right: 30px;
        }

        .card-body {
            width: 100%;
            padding-top: 20px;
        }

        .card-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 1.2rem;
        }

        .extra-data {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            text-align: center;
            font-size: 1.2rem;
        }

        .footer-basic {
            bottom: 0;
            margin-top: 500px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="left-section">
                    <img class="card-img-left" src="<?php echo $foto_profilo ?>" alt="Avatar">
                    <h4 class="card-title ms-3"><?php echo $nickname;?></h4>
                </div>
                
                <form method="get" action="modifica.php">
                    <button type="submit" class="btn btn-primary"><?= $TEXT['edit_button'] ?></button>
                </form>
            </div>

            <div class="card-body">
                <div class="info-row">
                    <span>🔷 <strong><?= $TEXT['username'] ?>:</strong> <?php echo $username;?></span>
                    <span>🎮 <strong><?= $TEXT['games_played'] ?>:</strong> <?php echo $n_giochi;?></span>
                    <span>⭐ <strong><?= $TEXT['points'] ?>:</strong> <?php echo $punteggio;?></span>
                    <span>📅 <strong><?= $TEXT['account_created'] ?>:</strong> <?php echo $data_reg;?></span>
                    <span>📧 <strong><?= $TEXT['email'] ?>:</strong> <?php echo $email;?></span>
                    <span>🌍 <strong><?= $TEXT['country'] ?>:</strong> <?php echo $nazione;?></span>
                </div>
            </div>
        </div>
    </div>

</body>

<?php include 'footer.php'; ?>

</html>

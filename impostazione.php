<?php
include 'menu.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo Giocatore</title>

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
            <!-- Intestazione con immagine, nome e pulsante -->
            <div class="card-header">
                <div class="left-section">
                    <img class="card-img-left" src="https://avatars.githubusercontent.com/u/161753396?v=4" alt="Avatar">
                    <h4 class="card-title ms-3">SlinkPompano</h4>
                </div>
                
                <form method="get" action="modifica.php">
                    <button type="submit" class="btn btn-primary">Modifica</button>
                </form>
            </div>

            <!-- Info principali -->
            <div class="card-body">
                <div class="info-row">
                    <span>🎮 <strong>Livello:</strong> 16</span>
                    <span>⭐ <strong>XP:</strong> 5080</span>
                    <span>📅 <strong>Account creato nel:</strong> Ottobre 2019</span>
                    <span>🏆 <strong>Achievement:</strong> 25</span>
                    <span>🥇 <strong>Platinum:</strong> 1</span>
                </div>
            </div>
        </div>
    </div>

</body>

<?php include 'footer.php'; ?>

</html>

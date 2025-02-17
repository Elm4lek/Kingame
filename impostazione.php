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
        body {
            font-family: 'Gochi Hand', cursive;
            background: #1e1e2f; /* Sfondo solido senza sfumature */
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .card {
            display: flex;
            flex-direction: column; /* Disposizione verticale per più spazio */
            width: 100%;
            max-width: 1200px;
            background: rgba(255, 255, 255, 0.1);
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
            width: 100%;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
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
            margin-bottom: 15px;
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

    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <!-- Intestazione con immagine e nome -->
            <div class="card-header">
                <img class="card-img-left" src="https://avatars.githubusercontent.com/u/161753396?v=4" alt="Avatar">
                <div>
                    <h4 class="card-title">SlinkPompano</h4>
                </div>
            </div>

            <!-- Info principali -->
            <div class="card-body">
                <div class="info-row">
                    <span>🎮 <strong>Livello:</strong> 16</span>
                    <span>⭐ <strong>XP:</strong> 5080</span>
                    <span>📚 <strong>Libreria:</strong> 25 giochi</span>
                    <span>🎮 <strong>Ore Giocate:</strong> 869</span>
                    <span>🏆 <strong>Achievement:</strong> 25</span>
                    <span>🥇 <strong>Platinum:</strong> 1</span>
                </div>

                <!-- Sezione extra per più dati -->
                <div class="extra-data">
                    <p>📅 <strong>Account creato nel:</strong> Ottobre 2019</p>
                    <p>🔥 <strong>Ultimo gioco giocato:</strong> Elden Ring</p>
                    <p>🎯 <strong>Obiettivo attuale:</strong> Completare al 100%</p>
                </div>
            </div>
        </div>
    </div>

</body>

<?php include 'footer.php'; ?>

</html>

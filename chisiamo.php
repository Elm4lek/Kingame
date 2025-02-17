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
    <title>Chi siamo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJ6H4L6gkR6mef1Pf4hzRfEXM04Cw9TAsii9FsZ0uSks8W5s7DFAaa7QK8YF" crossorigin="anonymous">
</head>
<style>

    .navbar{
    position:sticky;
    top: 0;
    z-index: 100;
    }

    body {
        font-family: 'Gochi Hand', cursive;
        color:white;s
    }

    .row{
        width:33%;
        margin: 0 auto;
        justify-items: center;
    }
    .container{
        margin-top: 5%;
        display: flex;
        flex-wrap: wrap;
    }
    .card{
        width: 80%;
        margin-bottom: 30%;
    }
    img{
        width: 200px;
        height: 200px;
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
<body>

    <div class="container  m-0 p-0">
        <div class="row">
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="https://avatars.githubusercontent.com/u/161753396?v=4" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Elam4lek</h4>
                        <p class="card-text">Programmatore dalla nascita, nato a colpi di cicli for e di linguaggi imperitivi, pronto a stupirvi con tutta la sua conoscenza.</p>
                        <a href="https://github.com/Elm4lek" class="btn btn-primary" target="_blank" >See Profile</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="https://avatars.githubusercontent.com/u/130972307?v=4" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Georgiana059</h4>
                        <p class="card-text">Pronta a supportare i componenti nel team per eventuali idee e apportare modifiche per miglioramenti.</p>
                        <a href="https://github.com/georgiana059" class="btn btn-primary" target="_blank" >See Profile</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="https://avatars.githubusercontent.com/u/190075560?v=4" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Sbettox</h4>
                        <p class="card-text">Manager di alto livello e autore coi fiocchi, capace di gestire i conflitti con ottime doti di problem solving.</p>
                        <a href="https://github.com/Sbettox" class="btn btn-primary" target="_blank" >See Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="https://avatars.githubusercontent.com/u/131394105?v=4" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Dyy</h4>
                        <p class="card-text">Da ben 17 anni combatte contro la stupidità delle persone, dando lezioni private sulla matematica e sulla programmazione.</p>
                        <a href="https://github.com/dyy0101" class="btn btn-primary" target="_blank" >See Profile</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="https://avatars.githubusercontent.com/u/190075051?v=4" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Edumelo</h4>
                        <p class="card-text">Un tornado di allegria, con la musica Brasiliana nel sangue rallegra sempre le giornate del team.</p>
                        <a href="https://github.com/edumelo-ludu" class="btn btn-primary" target="_blank" >See Profile</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="https://avatars.githubusercontent.com/u/191097751?v=4" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">IlSupo</h4>
                        <p class="card-text">Dal Perù con furore, sempre pronto a dare consigli costruttivi e ad ascoltare gli altri.</p>
                        <a href="https://github.com/IlSupo" class="btn btn-primary" target="_blank" >See Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="https://avatars.githubusercontent.com/u/128397937?v=4" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Abbassolgbtq</h4>
                        <p class="card-text">Direttamente da Alberobello un abile talento nel campo dei DB, capace di progettarlo e renderlo funzionante in breve tempo.</p>
                        <a href="https://github.com/abbassolgbtq" class="btn btn-primary" target="_blank" >See Profile</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="https://avatars.githubusercontent.com/u/190074916?v=4" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">AleVale2005</h4>
                        <p class="card-text">Il king di tutta Sesto San Giovanni, pronto a sfoderare tutta la sua simpatia e le sue hard skills da PR.</p>
                        <a href="https://github.com/AleVale2005" class="btn btn-primary" target="_blank" >See Profile</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="https://avatars.githubusercontent.com/u/133581691?v=4" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title"><Tarea></Tarea>Tomgun444</h4>
                        <p class="card-text">Abilissimo UX/UI Designer crea ottime icone in grado di invogliare il giocatore nella scelta e nel gameplay dei giochi.</p>
                        <a href="https://github.com/tomgun444" class="btn btn-primary" target="_blank" >See Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
<?php include 'footer.php'; ?>
</html>
<?php include'menu.php' ?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJ6H4L6gkR6mef1Pf4hzRfEXM04Cw9TAsii9FsZ0uSks8W5s7DFAaa7QK8YF" crossorigin="anonymous">
</head>
<style>
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
</style>
<body>

    <div class="container  m-0 p-0">
        <div class="row">
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="img/elmalek.jpg" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Elam4lek</h4>
                        <p class="card-text">Programmatore dalla nascita, nato a colpi di cicli for e di linguaggi imperitivi, pronto a stupirvi con tutta la sua conoscenza.</p>
                        <a href="#" class="btn btn-primary">Visita il profilo</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="../bootstrap4/img_avatar1.png" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Dyy</h4>
                        <p class="card-text">Da ben 17 anni combatte contro la stupidità delle persone, dando lezioni private sulla matematica e sulla programmazione. Attualmente frequenta l’università degli studi di Milano, studiando machine learning e l’AI. Un futuro talento nel campo high-tech!</p>
                        <a href="#" class="btn btn-primary">Visita il profilo</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="../bootstrap4/img_avatar1.png" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Sbettox</h4>
                        <p class="card-text">Manager di alto livello e autore coi fiocchi, capace di gestire i conflitti con ottime doti di problem solving. Futuro imprenditore e CEO di un’importante azienda!</p>
                        <a href="#" class="btn btn-primary">Visita il profilo</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="../bootstrap4/img_avatar1.png" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Abbassolgbtq</h4>
                        <p class="card-text">Direttamente da Alberobello un abile talento nel campo dei DB, capace di progettarlo e renderlo funzionante in breve tempo.</p>
                        <a href="#" class="btn btn-primary">Visita il profilo</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="../bootstrap4/img_avatar1.png" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Edumelo</h4>
                        <p class="card-text">Un tornado di allegria, con la musica Brasiliana nel sangue rallegra sempre le giornate del team ma è anche un ottimo aiutante e web designer.</p>
                        <a href="#" class="btn btn-primary">Visita il profilo</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="../bootstrap4/img_avatar1.png" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">IlSupo</h4>
                        <p class="card-text">Dal Perù con furore, sempre pronto a dare consigli costruttivi e ad ascoltare gli altri.</p>
                        <a href="#" class="btn btn-primary">Visita il profilo</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="../bootstrap4/img_avatar1.png" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Georgiana059</h4>
                        <p class="card-text">Pronta a supportare i componenti nel team per eventuali idee e apportare modifiche per miglioramenti.</p>
                        <a href="#" class="btn btn-primary">Visita il profilo</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="../bootstrap4/img_avatar1.png" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">AleVale2005</h4>
                        <p class="card-text">Il king di tutta Sesto San Giovanni, pronto a sfoderare tutta la sua simpatia e le sue hard skills da PR.</p>
                        <a href="#" class="btn btn-primary">Visita il profilo</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <img class="card-img-top" src="../bootstrap4/img_avatar1.png" alt="Card image" >
                    <div class="card-body">
                        <h4 class="card-title">Tomgun444</h4>
                        <p class="card-text">Abilissimo UX/UI Designer crea ottime icone in grado di invogliare il giocatore nella scelta e nel gameplay dei giochi.</p>
                        <a href="#" class="btn btn-primary">Visita il profilo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
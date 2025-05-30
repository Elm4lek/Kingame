<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};
require_once __DIR__ . '/../config.php';
require_once '../db_connect.php';

$haPosto = true;
if(!empty($_SESSION['gioco']) && !$_SESSION["gioco"]["isFinished"]){
    file_get_contents(host."/Kingame/MultiplayerSystem/removeSession.php?giocatore=".$_SESSION["username"]."&stanza=".$_SESSION['gioco']['stanza']);
}

$sql = "SELECT * FROM stanze INNER JOIN sessione ON stanze.Id = sessione.Stanza WHERE User = '".$_SESSION["username"]."' AND Stato = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        file_get_contents(host."/Kingame/MultiplayerSystem/removeSession.php?giocatore=".$_SESSION["username"]."&stanza=".$row["Id"]);
    }
}

$tipo = $_POST['tipo'];
$gioco = $_POST['gioco'];
$numero = $_POST['numero'];
$nome = $_SESSION['username'];

if($tipo == 'crea'){
    $sql = "SELECT * FROM stanze INNER JOIN giochi ON stanze.Gioco = giochi.ID ORDER BY stanze.Id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                "stanza" => (int)$row["Id"],
                "gioco" => $row["Nome"],
                "numero" => (int)$row["Numero_Giocatori"]
            );
        }
    }
    $stanza = 0;
    if(isset($data)){
        $stanza = $data[sizeof($data)-1]['stanza'];
        $stanza++;

    }
    $data = ['stanza' => $stanza, 'gioco' => $gioco];
    $sessione = ['giocatore' => $nome,'stanza' => $stanza];
    $_SESSION["gioco"]["capo"]=true;

}
else{
    $stanza = $_POST['stanza'];
    $sql = "SELECT Numero_Giocatori FROM giochi WHERE Id = '".$gioco."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $numero = $row["Numero_Giocatori"];
    }
    $sql = "SELECT COUNT(*) FROM sessione WHERE Stanza = ".$stanza;
    $giocatori = $conn->query($sql);

    if($giocatori === $numero){ // Mantenuta la logica originale di confronto
        $haPosto = false;
    }else{
        $sessione = ['giocatore' => $nome,'stanza' => $stanza];
    }
}
$sql = "SELECT Nome FROM giochi WHERE ID = ".$gioco."";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $gioco = $row["Nome"];
}

$conn->close();
if($haPosto){
    if($tipo == 'crea'){
        post($tipo,[$data,$sessione]);
    }
    else{
        post($tipo,[[],$sessione]);
    }
    $_SESSION['gioco']['stanza'] = $stanza;
    $_SESSION['gioco']['gioco'] = $gioco;
    $_SESSION['gioco']['numero'] = $numero;
    $_SESSION['gioco']['giocatore'] = $nome;
    $_SESSION['gioco']['isFinished'] = false;
    header("Location: StanzaAttesa.php");
    exit;
}
else{
    echo "<div id='allerta'>SI E' VERIFICATO UN ERRORE. <br> la stanza è già piena</div>";
    echo "<div>
            <a href = 'Home.php'>crea una nuova stanza</a>
            <a href = 'AggiungiStanza.php'>aggiungi in una stanza</a>
            </div>";
    $_SESSION['gioco'] = [];
}
function post($tipo, $data) {
    // Check for errors
    $url = 'http://'.host.'/kingame/MultiplayerSystem/AggiornaDB.php';
    $data = http_build_query(['tipo' => $tipo, 'data' => $data]);

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => $data,
        ],
    ];

    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

}

?>
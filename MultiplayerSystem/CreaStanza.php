<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};
$haPosto = true;
//if(empty($_SESSION['gioco'])){
$tipo = $_POST['tipo'];
$gioco = $_POST['gioco'];
$numero = $_POST['numero'];
$nome = $_SESSION['nome'];

$server = "localhost";
$conn = new mysqli($server,"root","","kingame")  or die (mysql_error());

if($tipo == 'crea'){
    $sql = "SELECT * FROM stanze INNER JOIN giochi ON stanze.Gioco = giochi.ID"; 
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                "stanza" => (int)$row["stanze.Id"],  
                "gioco" => $row["giochi.Nome"],
                "numero" => (int)$row["giochi.Numero_Giocatori"]
            );
        }
    }

    $stanza = 1;
    if(isset($data))
        $stanza = $data[sizeof($data)-1]['stanza']++;

    $data = ['stanza' => $stanza, 'gioco' => $gioco,'num' => $numero];
    $sessione = ['giocatore' => $nome,'stanza' => $stanza];
}
else{
    $stanza = $_POST['stanza'];

    $sql = "SELECT Numero_Giocatori FROM giochi WHERE Nome = ".$gioco; 
    $numero = $conn->query($sql);
    $sql = "SELECT COUNT(*) FROM sessione WHERE Stanza = ".$stanza; 
    $giocatori = $conn->query($sql);

    if($giocatori === $numero){
        $haPosto = false;
    }else{
        $sessione = ['giocatore' => $nome,'stanza' => $stanza];
    }
}
//}
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
    //header("Location: StanzaAttesa.php");
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
    $url = 'http://localhost/kingame/MultiplayerSystem/AggiornaDB.php';
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query(['tipo' => $tipo, 'data' => $data]),
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    // Check for errors
    if ($result === FALSE) {
        die('Error in request');
    }

    // Output real response
    var_dump($result);
}

?>

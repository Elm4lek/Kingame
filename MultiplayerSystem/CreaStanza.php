<?php
session_start();
$haPosto = true;
print_r($_SESSION);
if(empty($_SESSION['gioco'])){
    $tipo = $_POST['tipo'];
    $nome = $_SESSION['nome'];
    $server = "localhost";
    $conn = new mysqli($server,"root","","kingame")  or die (mysql_error());
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

    if($tipo == 'crea'){
        $gioco = $_POST['gioco'];
        $numero = $_POST['numero'];

        $stanza = 1;
        if(isset($data))
            $stanza = $data[sizeof($data)-1]['stanza']++;

        $data = ['stanza' => $stanza, 'gioco' => $gioco,'num' => $numero];
        $sessione = ['giocatore' => $nome,'stanza' => $stanza, 'gioco' => $gioco];
    }
    else{
        $stanza = $_POST['stanza'];
        $result = findByKeyValue($data, 'stanza', $stanza);
        $numero = $result['numero'];

        $sql = "SELECT COUNT(*) FROM sessione WHERE Stanza = ".$stanza." and In_Sessione = ".true; 
        $giocatori = $conn->query($sql);

        if($giocatori === $numero){
            $haPosto = false;
        }else{
            $sessione = ['giocatore' => $nome,'stanza' => $stanza, 'gioco' => $gioco];
        }
    }
}
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
    $_SESSION['gioco']['giocatore'] = $giocatore;
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
function post($tipo,$data){

    $url = 'AggiornaDB.php';
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query([$tipo,$data]),
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
}
?>

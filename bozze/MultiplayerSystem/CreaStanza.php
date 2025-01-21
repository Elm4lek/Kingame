<?php
session_start();
$haPosto = true;
if(empty($_SESSION['gioco'])){
    $tipo = $_POST['tipo'];
    $nome = $_POST['nome'];
    $server = "localhost";
    $conn = new mysqli($server,"root","","kingame")  or die (mysql_error());
    $sql = "SELECT * FROM stanze"; 
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                "stanza" => (int)$row["Id"],  
                "gioco" => $row["Gioco"],
                "numero" => (int)$row["Numero"]
            );
        }
    }

    $st = array_column($data, 'stanza');
    array_multisort($st, SORT_ASC, $data);

    if($tipo == 'crea'){
        $gioco = $_POST['gioco'];
        $numero = $_POST['numero'];

        $stanza = 1;
    
        for ($i = 0 ; $i < sizeof($data); $i++){
            if($stanza == $data[$i]['stanza']){
                $stanza ++;
            }
        }

        $data = ['stanza' => $stanza, 'gioco' => $gioco,'num' => $numero,'giocatore' => $nome];

    }
    else{
        $stanza = $_POST['stanza'];
        $result = findByKeyValue($data, 'stanza', $stanza);

        $numero = $result['numero'];

        $sql = "SELECT COUNT(*) FROM utenti WHERE StanzaId = ".$stanza; 
        $giocatori = $conn->query($sql);

        if($giocatori === $numero){
            $haPosto = false;
        }else{
            $data = ['stanza' => $stanza,'giocatore' => $nome];
        }
    }
}
if($haPosto){
    $url = 'AggiornaDB.php';
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($server, false, $context);
    $context = stream_context_create($options);
    $_SESSION['gioco']['stanza'] = $stanza;
    $_SESSION['gioco']['nome'] = $nome;
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
?>

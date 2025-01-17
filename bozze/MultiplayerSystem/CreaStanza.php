<?php
session_start();
$haPosto = true;
if(empty($_SESSION['gioco'])){
    $tipo = $_POST['tipo'];
    $nome = $_POST['nome'];
    $gioco = $_POST['gioco'];
    $numero = $_POST['numero'];
    $server = "localhost";
    $conn = new mysqli($server,"root","","kingame")  or die (mysql_error());
    $sql = "SELECT * FROM stanze"; 
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                "stanza" => (int)$row["Id"],  
                "gioco" => $row["Gioco"],
                "giocatore" => (int)$row["Numero"]
            );
        }
    }


    if($tipo == 'crea'){

        $stanza = 1;
    
        sort($data);
    
        for ($i = 0 ; $i < sizeof($data); $i++){
            if($stanza == $data[$i]['stanza']){
                $stanza ++;
            }
        }

        $data = ['stanza' => $stanza, 'gioco' => $gioco,'num' => $numero,'giocatore' => $nome];

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
    }
    else{
        $stanza = $_POST['stanza'];
        $sql = "SELECT COUNT(*) FROM giocatori WHERE Stanza = ".$stanza; 
        $result = $conn->query($sql);

        if($result === $numero){
            $haPosto = false;
        }else{
            $giocatore[] = $newJ;
            $data[$index]['giocatore'] = $giocatore;
        }
    }
    if($haPosto){

        $newJson = json_encode($json);
        file_put_contents('Stanze.json', $newJson);    

        $_SESSION['gioco']['stanza'] = $stanza;
        $_SESSION['gioco']['nome'] = $nome;
        $_SESSION['gioco']['gioco'] = $gioco;
        $_SESSION['gioco']['numero'] = $numero;
        $_SESSION['gioco']['giocatore'] = $giocatore;
    }
}
if($haPosto){
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

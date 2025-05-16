<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};
$haPosto = true;
print_r($_SESSION);
echo "<br>";
print_r($_POST);
if(!empty($_SESSION['gioco'])){
    file_get_contents("http://localhost/Kingame/MultiplayerSystem/removeSession.php?giocatore=".$_SESSION["username"]."&stanza=".$_SESSION['gioco']['stanza']);
}
$tipo = $_POST['tipo'];
$gioco = $_POST['gioco'];
$numero = $_POST['numero'];
$nome = $_SESSION['username'];

$server = "localhost";
$conn = new mysqli($server,"root","","kingame")  or die (mysql_error());

if($tipo == 'crea'){
    $sql = "SELECT * FROM stanze INNER JOIN giochi ON stanze.Gioco = giochi.ID"; 
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
}
else{
    $stanza = $_POST['stanza'];
    $sql = "SELECT Numero_Giocatori FROM giochi WHERE Id = '".$gioco."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // oppure fetch_row() se preferisci un array numerico
        $numero = $row["Numero_Giocatori"];
    }
    $sql = "SELECT COUNT(*) FROM sessione WHERE Stanza = ".$stanza; 
    $giocatori = $conn->query($sql);

    if($giocatori === $numero){
        $haPosto = false;
    }else{
        $sessione = ['giocatore' => $nome,'stanza' => $stanza];
    }
}
$sql = "SELECT Nome FROM giochi WHERE ID = ".$gioco.""; 
echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // oppure fetch_row() se preferisci un array numerico
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
    $url = 'http://localhost/kingame/MultiplayerSystem/AggiornaDB.php';
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

    echo $response;
}

?>

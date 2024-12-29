
<?php
    session_start();
    $haPosto = true;
    if(empty($_SESSION['gioco'])){
        $tipo = $_POST['tipo'];
        
        $string = file_get_contents("Stanze.json");
        $json = json_decode($string,true);

        $nome = $_POST['nome'];

        $newJ = array("nome"=>$nome,"img"=>"https://avatars.githubusercontent.com/u/131394105?v=4");

        if($tipo == 'crea'){
            $gioco = $_POST['gioco'];
            $numero = $_POST['numero'];
            $stanza = 1;
        
            $st = array_column($json, 'stanza');
            array_multisort($st, SORT_ASC, $json);
        
            for ($i = 0 ; $i < sizeof($json); $i++){
                if($stanza == $json[$i]['stanza']){
                    $stanza ++;
                }
            }
        
        
            $giocatore = array();

            $giocatore[] = $newJ;
            $newStanza = array("stanza"=>$stanza, "gioco"=>$gioco, "numero"=>(int)$numero, "giocatore"=>$giocatore);
            $json[] = $newStanza;

        }
        else{
            $stanza = $_POST['stanza'];
            for($i = 0; $i < sizeof($json); $i++){
                if($json[$i]['stanza'] == $stanza){
                    $partita = $json[$i];
                    $index = $i;
                }
            }
            $giocatore = $partita['giocatore'];
            $numero = $partita['numero'];
            $gioco = $partita['gioco'];
            if(sizeof($giocatore) === $numero){
                $haPosto = false;
            }else{
                $giocatore[] = $newJ;
                $json[$index]['giocatore'] = $giocatore;
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

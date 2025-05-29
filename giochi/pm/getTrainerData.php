<?php
    require_once '../../db_connect.php';
    $json = file_get_contents('php://input');

    // Decodifica il JSON in un array associativo
    $post = json_decode($json, true);
    $id = $post["id"];
    $stmt = $conn->prepare("SELECT 
                                Nome, 
                                descrizione.eng AS Descrizione, 
                                Regione, 
                                prebattaglia.eng AS Prebattaglia, 
                                primoko.eng AS PrimoKO, 
                                finebattaglia.eng AS Finebattaglia, 
                                Trainer_ID,
                                winnings
                            FROM pm_npc  
                            INNER JOIN pm_trainer USING(Trainer_ID)
                            INNER JOIN testi descrizione ON pm_npc.Descrizione = descrizione.name
                            INNER JOIN testi prebattaglia ON pm_npc.Prebattaglia = prebattaglia.name
                            INNER JOIN testi primoko ON pm_npc.PrimoKO = primoko.name
                            INNER JOIN testi finebattaglia ON pm_npc.Finebattaglia = finebattaglia.name
                            WHERE NPC_ID = '".$id."';");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows >0) {
        $row = $result->fetch_assoc();
        $trainer = $row;
        //conn for user's bag items
        $stmt = $conn->prepare("SELECT * FROM pm_trainer 
                                INNER JOIN pm_borsa USING(Trainer_ID)
                                LEFT JOIN pm_oggetti USING(Oggetto_ID)
                                WHERE Trainer_ID = '".$trainer["Trainer_ID"]."';");
        $stmt->execute();
        $result = $stmt->get_result();
        $borsa = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $borsa[] = $row;
            }
        }
        
        //conn for user's pokemons
        $stmt = $conn->prepare("SELECT *
                                FROM pm_trainer 
                                INNER JOIN pm_squadra USING(Trainer_ID)
                                INNER JOIN pokemon USING(Pokedex)
                                INNER JOIN pm_img USING(Pokedex)
                                WHERE Trainer_ID = ".$trainer["Trainer_ID"].";");

        $stmt->execute();
        $result = $stmt->get_result();
        $squadra = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $pokemon["id"] = $row["PM_ID"];
                $pokemon["pokedex"] = $row["Pokedex"];
                $pokemon["stato"] = $row["Stato"];
                $pokemon["nome"] = $row["nome"];
                $pokemon["ps"] = $row["PS"];
                $pokemon["atk"] = $row["Atk"];
                $pokemon["atksp"] = $row["AtkSP"];
                $pokemon["dif"] = $row["Dif"];
                $pokemon["difsp"] = $row["DifSP"];
                $pokemon["vel"] = $row["Vel"];
                $pokemon["tipo1"] = $row["tipo1"];
                $pokemon["tipo2"] = $row["tipo2"];
                $pokemon["img"] = $row["Sprite_url"];
                $squadra[] = $pokemon;
            }
        }
        for($i=0; $i < sizeof($squadra); $i++){
            
            //conn for user's pokemons
            $stmt = $conn->prepare("SELECT pm_mossa.* FROM pm_squadra INNER JOIN pm_mossa ON pm_squadra.Mossa1 = pm_mossa.MT WHERE PM_ID = ".$squadra[$i]["id"]." UNION 
                                    SELECT pm_mossa.* FROM pm_squadra INNER JOIN pm_mossa ON pm_squadra.Mossa2 = pm_mossa.MT WHERE PM_ID = ".$squadra[$i]["id"]." UNION
                                    SELECT pm_mossa.* FROM pm_squadra INNER JOIN pm_mossa ON pm_squadra.Mossa3 = pm_mossa.MT WHERE PM_ID = ".$squadra[$i]["id"]." UNION
                                    SELECT pm_mossa.* FROM pm_squadra INNER JOIN pm_mossa ON pm_squadra.Mossa4 = pm_mossa.MT WHERE PM_ID = ".$squadra[$i]["id"]." ;");

            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $squadra[$i]["mossa"][] = $row;
                }
            }
        }
        for($i=0; $i < sizeof($squadra); $i++){
            //conn for user's pokemons
            $stmt = $conn->prepare("SELECT * FROM pm_tipo WHERE Tipo = '".$squadra[$i]["tipo1"]."' UNION 
                                    SELECT * FROM pm_tipo WHERE Tipo = '".$squadra[$i]["tipo2"]."' ;");

            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $debolezza = [];
                while($row = $result->fetch_assoc()){
                    $d = [];
                    foreach ($row as $tipo => $valore) {
                        if($tipo == "Tipo") continue; 
                        $d[$tipo] = (float)$valore;
                    }
                    $debolezza[] = $d;
                }
                if(sizeof($debolezza)>1){
                    $debolezzaFinale = [];
                    foreach ($debolezza[0] as $tipo => $valore1) {
                        $valore2 = isset($debolezza[1][$tipo]) ? $debolezza[1][$tipo] : 1.0;
                        $debolezzaFinale[$tipo] = $valore1 * $valore2;
                    }
                    $squadra[$i]["debolezze"]= $debolezzaFinale;
                }
                else $squadra[$i]["debolezze"]= $debolezza;
            }
        }
        $dati = [
            "trainer" => $trainer,
            "bag" => $borsa,
            "team" => $squadra
        ];
        echo json_encode($dati);
    }
?>
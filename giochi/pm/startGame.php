<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require_once '../../db_connect.php';
    $username = $_SESSION["username"];
    $nickname = $_SESSION["nickname"];
    $stmt = $conn->prepare("SELECT * FROM pm_user 
                            INNER JOIN pm_trainer USING(Trainer_ID)
                            WHERE ID = '".$username."';");
    $stmt->execute();
    $stmt->get_result();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $trainer = $row;
        //conn for user's bag items
        $stmt = $conn->prepare("SELECT * FROM pm_trainer 
                                INNER JOIN pm_borsa USING(Trainer_ID)
                                LEFT JOIN pm_oggetti USING(Oggetto_ID)
                                WHERE Trainer_ID = '".$data["Trainer_ID"]."';");
        $stmt->execute();
        $stmt->get_result();
        $result = $stmt->get_result();
        $borsa = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $borsa = [$row];
            }
        }
        
        //conn for user's pokemons
        $stmt = $conn->prepare("SELECT * FROM pm_trainer 
                                INNER JOIN pm_squadra USING(Trainer_ID)
                                INNER JOIN pm_mossa mossa1 ON pm_squadra.Mossa1 = mossa1.MT
                                INNER JOIN pm_mossa mossa2 ON pm_squadra.Mossa2 = mossa2.MT
                                INNER JOIN pm_mossa mossa3 ON pm_squadra.Mossa3 = mossa3.MT
                                INNER JOIN pm_mossa mossa4 ON pm_squadra.Mossa4 = mossa4.MT
                                INNER JOIN pokemon USING(Pokedex)
                                INNER JOIN pm_img USING(Pokedex)
                                INNER JOIN pm_tipo tipo1 USING(Pokedex) ON pokemon.tipo1 = tipo1.Tipo
                                INNER JOIN pm_tipo tipo2 USING(Pokedex) ON pokemon.tipo2 = tipo2.Tipo
                                WHERE Trainer_ID = '".$data["Trainer_ID"]."';");
        $stmt->execute();
        $stmt->get_result();
        $result = $stmt->get_result();
        $squadra = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $squadra = [$row];
            }
        }
    }
    else{
        $stmt = $conn->prepare("SELECT Trainer_ID FROM pm_trainer ORDER BY DESC LIMIT 1");
        $stmt->execute();
        $stmt->get_result();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $trainer_id = $row["Trainer_ID"];
            $trainer_id += 1;
        }
        else{
            $trainer_id = 0;
        }

        $stmt = $conn->prepare("INSERT INTO pm_user(Trainer_ID, tipo) 
                                VALUES($trainer_id,'giocatore');");
        $stmt->execute();
        $stmt->get_result();
        $result = $stmt->get_result();
        $stmt = $conn->prepare("INSERT INTO pm_user(ID, Nome, livello, soldi,Trainer_ID) 
                                VALUES('$username','$nickname',0,400,$trainer_id);");
        $stmt->execute();
        $stmt->get_result();
        $result = $stmt->get_result();
    }

    $conn->close();
?>
<?php 
    session_start();
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    $logsValue = "";
    $movesCodes = "";

    if ($gameData[4][$gameData[1]] == $_SESSION['id']) {
        echo $gameData[0];
        if ($gameData[0] == 2 || $gameData[0] == 1 || ($gameData[0] == 0 && $gameData[6][$gameData[1]] == 8)) {
            if ($gameData[0] == 0 && $gameData[6][$gameData[1]] == 8) {
                $gameData[2][0] = 1;
                $gameData[2][1] = 0;
            }
            $whoTour = $gameData[1];
            $tour = "";
            if ($gameData[2][0] == $gameData[2][1] || $gameData[0] == 1) {
                $whoTour = $gameData[1];
            } else {
                $players = $gameData[4];
                $playersNum = 0;
                for ($i = 0; $i < 4; $i++) {
                    if ($players[$i] != 0) {
                        $playersNum++;
                    }
                }
                if ($whoTour == $playersNum-1) {
                    $result = $connection -> query("SELECT tour FROM game WHERE gameID = ".$_SESSION['gameId']);
                    $row = $result -> fetch_object();
                    $whoTour = 0;
                    $tour = ", tour=tour+1";
                    $logsValue .="<hr class=\"L_tourHrEnd\">";
                    $logsValue .="<span>Tura: ".(intval($row->tour)+1)."</span>";
                    $logsValue .="<hr class=\"L_tourHrEnd\">";
                    $logsValue .="<hr class=\"L_tourHrNext\">";
                    $logsValue .="<span>Tura gracza: ".($whoTour+1)."</span>";
                } else {
                    $whoTour = $gameData[1]+1;
                    $logsValue .="<hr class=\"L_tourHrNext\">";
                    $logsValue .="<span>Tura gracza: ".($whoTour+1)."</span>";
                }
            }
            if ($gameData[6][$gameData[1]] == 8 && $gameData[3][$gameData[1]] != 0) {
                $gameData[3][$gameData[1]] -= 1;
                $movesCodes = ",movesCodes = \"".implode(":", $gameData[3])."\"";
            }
            $sql = 'UPDATE game SET trowed = NULL, eventCode = 0, whosTour = '.$whoTour.$tour.$movesCodes.' WHERE gameID = '.$_SESSION["gameId"];
            echo $sql;
            $sql2 = 'UPDATE game SET logs = CONCAT(logs, \''.$logsValue.'\') WHERE gameID = '.$_SESSION["gameId"];
            $connection -> multi_query($sql.";".$sql2);
            exit();
        } else {
            echo "Error";
            exit();
        }
    } else {
        echo "Error";
        exit();
    }
    
    
?>
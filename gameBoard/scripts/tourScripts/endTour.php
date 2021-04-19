<?php 
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    if ($gameData[4][$gameData[1]] == $_SESSION['id']) {
        echo $gameData[0] ;
        if ($gameData[0] == 2 || $gameData[0] == 1) {
            $whoTour = $gameData[1];
            $tour = "";
            if ($gameData[2][0] == $gameData[2][1]) {
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
                    $whoTour=0;
                } else {
                    $whoTour = $gameData[1]+1;
                    $tour = ", tour=tour+1";
                }
            }
            $sql = 'UPDATE game SET trowed = NULL, eventCode = 0, whosTour = '.$whoTour.$tour.' WHERE gameID = '.$_SESSION["gameId"];
            $connection->query($sql);
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
<?php 
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    if ($gameData[4][$gameData[1]] == $_SESSION['id']) {
        if ($gameData[0] == 0) {
            $trow1 = rand(1,6);
            $trow2 = rand(1,6);
            $gameData[6][$gameData[1]] += $trow1 + $trow2;
            if ($gameData[6][$gameData[1]] > 31) {
                $gameData[6][$gameData[1]] -= 31;
                $gameData[9][$gameData[1]] += 200000;
            } 
            $sql = 'UPDATE game SET money = "'.implode(":",$gameData[9]).'", place = "'.implode(":",$gameData[6]).'", trowed = "'.$trow1.$trow2.'", eventCode = 1 WHERE gameID = '.$_SESSION["gameId"];
            $connection->query($sql);
            echo $trow1.":".$trow2;
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
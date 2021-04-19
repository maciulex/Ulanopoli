<?php 
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    if ($gameData[4][$gameData[1]] == $_SESSION['id']) {
        if ($gameData[0] == 0) {
            //$trow1 = rand(1,6);
            //$trow2 = rand(1,6);
            $trow1 = 0;
            $trow2 = 0;
            $gameData[6][$gameData[1]] += $trow1 + $trow2;
            if ($gameData[6][$gameData[1]] > 31) {
                $gameData[6][$gameData[1]] -= 31;
                $gameData[9][$gameData[1]] += 200000;
                $gameData[11][$gameData[1]] += 200000;
            } 
            $fildInfo = explode(":",$gameData[5][$gameData[6][$gameData[1]]]);
            $fildInfo[0] = intval($fildInfo[0]);
            $fildInfo[1] = intval($fildInfo[1]);
            if ($fildInfo[0] != $gameData[1]+1 && $fildInfo[0] != 0) {
                $data = array();
                $sql = "SELECT * FROM filds WHERE id = ".$gameData[6][$gameData[1]];
                $result = $connection -> query($sql);
                while ($row = $result -> fetch_object()) {
                    $data[] = $row->l1;
                    $data[] = $row->l2;
                    $data[] = $row->l3;
                    $data[] = $row->l4;
                    $data[] = $row->l5;
                    $data[] = $row->l1;
                }
                $gameData[9][$gameData[1]] -= $data[$fildInfo[1]];
                $gameData[11][$gameData[1]] -= $data[$fildInfo[1]];
                $gameData[9][$fildInfo[0]-1] += $data[$fildInfo[1]];
                $gameData[11][$fildInfo[0]-1] += $data[$fildInfo[1]];
            }
            $sql = 'UPDATE game SET money = "'.implode(":",$gameData[9]).'",wealth="'.implode(":",$gameData[11]).'", place = "'.implode(":",$gameData[6]).'", trowed = "'.$trow1.$trow2.'", eventCode = 1 WHERE gameID = '.$_SESSION["gameId"];
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
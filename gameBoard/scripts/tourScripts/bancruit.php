<?php
    session_start();
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    if (!isset($_SESSION['id']) || $gameData[4][$gameData[1]]  != $_SESSION['id'] || !isset($_SESSION['gameId'])) {
        echo "Fatal_Error";
        exit();
    }
    for ($i = 1; $i < 31; $i++) {
        $sadState = false;
        switch ($i) {
            case 8:
            case 12:
            case 16:
            case 20:
            case 24:
            case 28:
            case 30:
                $sadState = true;
            break;
        }
        if ($sadState) {
            continue;
        }
        $fild = explode(":",$gameData[5][$i]);
        if ($gameData[1] == intval($fild[0])-1) {
            $fild = "0:0:".$fild[2];
            $gameData[5][$i] = $fild;
        }
    }
    $gameData[13][$gameData[1]] = 1;
    print_r($gameData[5]);
    $sql = 'UPDATE game SET bancruit = "'.implode(":", $gameData[13]).'", fildsNfo = "'.implode(";",$gameData[5]).'", eventcode = 2 WHERE gameID = '.$_SESSION['gameId'];
    echo $sql;
    $connection -> query($sql);
?>
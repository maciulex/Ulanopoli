<?php 
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    if ($gameData[4][$gameData[1]] == $_SESSION['id']) {
        echo "true;".$gameData[0].";".$gameData[2].";".implode(":",$gameData[6]);
    } else {
        echo false;
    }
    
    
?>
<?php 
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    if ($gameData[4][$gameData[1]] != $_SESSION['id']) {
        echo "ERROR";
        mysqli_close($connection);
        exit();
    } else {
        $logsValue = "";
        $NonChance = true;
        switch ($gameData[6][$gameData[1]]) {
            case 12:
            case 20:
            case 28:
                $NonChance = false;
            break;
        } 
        if ($NonChance) {
            echo "ERROR";
            $logsValue = "<span>Gracz próbuje cheatować i ukraść kartę ale nie kekw</span>";
            $sql = 'UPDATE game SET logs = CONCAT(\''.$logsValue.'\',logs) WHERE gameID = '.$_SESSION["gameId"];
            $connection -> query($sql);
            mysqli_close($connection);
            exit();
        }
        $cardSymbol;
        $cardId = rand(0,0);
        switch ($cardId) {
            case 0:
                //island escape
                $cardSymbol = "a";
            break;
            case 1:

            break;
            case 2:
                
            break;
            case 3:

            break;
            case 4:
        
            break;
            case 5:

            break;
            case 6:
                
            break;
            case 7:

            break;
            case 8:
                
            break;
            case 9:
    
            break;
        }
        if (strpos($gameData[8][$gameData[1]],$cardSymbol) !== false) {
            echo "1";
            $pos = strpos($gameData[8][$gameData[1]],$cardSymbol);
            $numberOfCards = intval($gameData[8][$gameData[1]][$pos+2]);
            $numberOfCards+=1;
            $gameData[8][$gameData[1]][$pos+2] = $numberOfCards;
            $logsValue .= "Gracz używa karty by wyjść na wolność!";
        } else {
            echo "2";
            $gameData[8][$gameData[1]].=$cardSymbol."x"."1";
        }
        echo ":true";
        $sql = "UPDATE game SET cards = \"".implode(":",$gameData[8])."\" WHERE gameID=".$_SESSION['gameId'];
        $sql2 = 'UPDATE game SET logs = CONCAT(\''.$logsValue.'\',logs) WHERE gameID = '.$_SESSION["gameId"];
        $connection -> multi_query($sql.";".$sql2);
    }

?>
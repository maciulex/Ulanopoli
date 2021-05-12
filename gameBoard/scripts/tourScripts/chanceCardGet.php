<?php 
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    if ($gameData[4][$gameData[1]] != $_SESSION['id'] && ($gameData[0] == 1 || $gameData[0])) {
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
        $cardFullName;
        $cardId = rand(0,2);
        switch ($cardId) {
            case 0:
                //island escape
                $cardSymbol = "a";
                $cardFullName = "Kartę ucieczki z wyspy";
            break;
            case 1:
                $cardSymbol = "b";
                $cardFullName = "Zniżka studencka -50% czynszu";
            break;
            case 2:
                $cardSymbol = "c";
                $cardFullName = "Podatek od bogactwa +50% czynszu.";
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
            $logsValue .= "<span>Gracz dostaje kartę: $cardFullName!</span>";
        } else {
            echo "2";
            $gameData[8][$gameData[1]].=$cardSymbol."x"."1";
        }
        echo ":true:".$cardFullName;
        $sql = "UPDATE game SET cards = \"".implode(":",$gameData[8])."\", eventCode=2 WHERE gameID=".$_SESSION['gameId'];
        $sql2 = 'UPDATE game SET logs = CONCAT(\''.$logsValue.'\',logs) WHERE gameID = '.$_SESSION["gameId"];
        $connection -> multi_query($sql.";".$sql2);
    }

?>
<?php 
    session_start();
    if (!isset($_SESSION["id"]) || !isset($_SESSION["gameId"])) {
        echo "Fatal_Error";
        exit();
    }
    if (!(@include_once "../../../base.php")) {
        echo "Fatal_Error";
        exit();
    } 
    @$connection = new mysqli($host, $db_user, $db_passcode, $db_name);
    if ($connection -> connect_errno > 0) {
        echo "Connection_Error";
        exit();
    } else {
        $sql = "SELECT eventCode, whosTour, trowed, movesCodes, players, fildsNfo, place, gameStatus, cards, money, islands, wealth, championsFild,bancruit,rounds FROM game WHERE gameID = ". $_SESSION["gameId"];
        $result = $connection -> query($sql);
        while ($row = $result -> fetch_object()) {
            $gameData[] = intval($row -> eventCode);
            $gameData[] = intval($row -> whosTour);
            $gameData[] = $row -> trowed;
            $gameData[] = explode(":",$row -> movesCodes);
            $gameData[] = explode(":",$row -> players);
            $gameData[] = explode(";",$row -> fildsNfo);
            $gameData[] = explode(":",$row -> place);
            $gameData[] = intval($row -> gameStatus);
            $gameData[] = explode(":",$row -> cards);
            $gameData[] = explode(":",$row -> money);
            $gameData[] = explode(":",$row -> islands);
            $gameData[] = explode(":",$row -> wealth);
            $gameData[] = intval($row -> championsFild);
            $gameData[] = explode(":",$row -> bancruit);
            $gameData[] = explode(":",$row -> rounds);
            for ($i = 0; $i < 4; $i++) {
                $gameData[3][$i] = intval($gameData[3][$i]);
                $gameData[4][$i] = intval($gameData[4][$i]);
                $gameData[6][$i] = intval($gameData[6][$i]);
                $gameData[9][$i] = intval($gameData[9][$i]);
                $gameData[10][$i] = intval($gameData[10][$i]);
                $gameData[11][$i] = intval($gameData[11][$i]);
                $gameData[13][$i] = intval($gameData[13][$i]);
                $gameData[14][$i] = intval($gameData[14][$i]);
            }
        }
        $gameData[] = array();
        for ($i = 0; $i < 4; $i++) {
            if ($gameData[4][$i] == 0) {
                continue;
            }
            $sql = "SELECT nickname FROM users WHERE id = ".$gameData[4][$i];
            $result = $connection -> query($sql);
            $row = $result -> fetch_object();
            $gameData[15][] = $row->nickname;
        }
    }
?>
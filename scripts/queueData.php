<?php
    session_start();
    if (!isset($_SESSION['gameId']) || !isset($_SESSION['id'])) {
        echo "ERROR";
        exit();
    }
    @require_once "../base.php";
    $connection = new mysqli($host, $db_user, $db_passcode, $db_name);
    if ($connection -> connect_errno > 0) {
        echo "Fatal_ERROR";
        exit();
    } else {
        $data = array();
        $sql = "SELECT gameStatus, activePlayer, maxPlayers, baseMoney, time, timeForTour, players FROM game WHERE gameID = ".$_SESSION['gameId'];
        $result = $connection -> query($sql);
        $row = $result->fetch_object();
        $data[] = $row -> gameStatus;
        $data[] = $row -> activePlayer;
        $data[] = $row -> maxPlayers;
        $data[] = $row -> baseMoney;
        $data[] = $row -> time;
        $data[] = $row -> players;
        $data[] = $row -> timeForTour;
        
        $img = array();
        $playersAddData = array();
        $playerMeData = array();
        $playersStats = array();
        $playersUnpack = explode(":",$data[5]);

        for ($i = 0; $i < 4; $i++) {
            if ($playersUnpack[$i] == "0") {
                $playersAddData[] = "";
                $playersStats[] = "";
                $playerMeData[] = "";
                $img[] = "";
                continue;
            }
            if (file_exists("../avatars/".$playersUnpack[$i].".jpg")) {
                $img[] = "true";
            } else {
                $img[] = "false";
            }
            $sql = "SELECT nickname, statistic FROM users WHERE id = ".$playersUnpack[$i];
            $result = $connection -> query($sql);
            $row = $result -> fetch_object();
            $playersAddData[] = $row->nickname;
            $playersStats[] = $row->statistic;
            $playerMeData[] = (intval($playersUnpack[$i]) == $_SESSION['id']) ? "true":"false";
        }

        echo $data[0].";;";
        echo $data[1].";;";
        echo $data[2].";;";
        echo $data[3].";;";
        echo $data[4].";;";
        echo $data[5].";;";
        echo implode(":", $img).";;";
        echo implode(":", $playersAddData).";;";
        echo implode("::", $playersStats).";;";
        echo implode(":", $playerMeData).";;";
        echo $data[6];

        mysqli_close($connection);
    }
?>
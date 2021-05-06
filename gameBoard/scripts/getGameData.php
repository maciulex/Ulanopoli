<?php
    session_start();
    if (!isset($_SESSION["id"]) || !isset($_SESSION["gameId"])) {
        echo "Error";
        exit();
    }
    if (!(include_once "../../base.php")) {
        echo "Error";
        exit();
    } 
    $connection = new mysqli($host, $db_user, $db_passcode, $db_name);
    if ($connection -> connect_errno > 0) {
        echo "Error";
        exit();
    } else {
        $players;
        $maxPlayers;
        $sql = "SELECT * FROM game WHERE gameID = ".$_SESSION["gameId"];
        $result = $connection -> query($sql);
        $row = $result -> fetch_object();
        echo $row->serverName.";;";
        echo $row->gameStatus.";;";
        echo $row->activePlayer.";;";
        echo $row->baseMoney.";;";
        echo $row->maxPlayers.";;";
        $maxPlayers = $row->maxPlayers;
        echo $row->time.";;";
        echo $row->timeForTour.";;";
        echo $row->tour.";;";
        echo $row->eventCode.";;";
        echo $row->logs.";;";
        echo $row->players.";;";
        $players = $row->players;
        echo $row->startTime.";;";
        echo $row->whosTour.";;";
        echo $row->fildsNfo.";;";
        echo $row->place.";;";
        echo $row->money.";;";
        echo $row->cards.";;";
        echo $row->trowed.";;";
        echo $row->movesCodes.";;";
        echo $row->islands.";;";
        echo $row->wealth.";;";
        echo $row->championsFild.";;";
        $rounds = $row->rounds.";;";
        $players = explode(":", $players);
        for ($i = 0; $i < $maxPlayers; $i++) {
            $sql = "SELECT * FROM users WHERE id = ".intval($players[$i]);
            $result = $connection -> query($sql);
            while ($row = $result -> fetch_object()) {
                echo $row->nickname.":";
            }
        }
        echo ";;".$rounds;

    }
?>
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
        while ($row = $result -> fetch_object()) {
            echo $row->gameStatus.";;";
            echo $row->activePlayer.";;";
            echo $row->tour.";;";
            echo $row->eventCode.";;";
            echo $row->players.";;";
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
            echo $row->rounds;
        }
    }
?>
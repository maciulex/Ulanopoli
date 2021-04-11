<?php
    session_start();
    if (isset($_GET["d"])) {
        if (file_exists("avatars/".$_GET["d"].".jpg")) {
            echo "true";
        } else {
            echo "false";
        }
        return;
    }
    $playerNumber = 0;
    $players = explode(":", $_GET["q"]);
    $player = Array ();
    for ($i = 0; $i<=3; $i++) {
        if ($players[$i] != 0 && $players[$i] != $_SESSION['id']) {
            $playerNumber++;
            $player [] = intval($players[$i]);
        }
    }
    if ($playerNumber == 0) {
        return;
    }
    require_once "base.php";
    $connection = new mysqli($host, $db_user, $db_passcode, $db_name);
    if ($connection->connect_errno !=0) {
        echo "Error: ".$connection->connection_errno;
    } else {
        $res = "";
        for ($i = 0; $i < $playerNumber; $i++) {
            $sql = "SELECT id, nickname, statistic FROM users WHERE id = ?";
            $stmt = $connection -> prepare($sql);
            $stmt -> bind_param("i", $player[$i]);
            $stmt -> execute();
            $stmt -> store_result();
            $stmt -> bind_result($id ,$nick, $stat);
            $stmt -> fetch();
            $stmt -> close();
            if ($i == 0) {
                $res = $id."..".$nick.";;".$stat;
            } else {
                $res .= "::".$id."..".$nick.";;".$stat;  
            }
        }
        $_SESSION["PLAYERS"] = $res;
        echo $res;
        mysqli_close($connection);
    }

?>
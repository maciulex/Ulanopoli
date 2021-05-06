<?php 
    session_start();
    if (!isset($_SESSION['logged'])) {
        header("Location: ../index.php");
        exit();
    }
    if (isset($serverName)) { 
        exit();
    }
    $playerID = intval($_SESSION['id']);
    $gameId = intval($_REQUEST['q']);
    $_SESSION['gameId'] = $gameId;
    $passcode = false;

    if (isset($_REQUEST['p'])) {
        $passcode = $_REQUEST['p'];
    }

	require_once "../base.php";
	$connection = new mysqli($host, $db_user, $db_passcode, $db_name);
	if ($connection->connect_errno !=0) {
		echo "Error: ".$connection->connection_errno;
	} else {
        $alfa;
        $maxPlayers;
        $activePlayers;
        $money;
        $players;
        if ($passcode === false) {
            $sql = "SELECT maxPlayers, activePlayer, baseMoney, players, serverName, gameStatus, time, timeForTour FROM game WHERE gameID = ?";
            $stmt = $connection -> prepare($sql);
            $stmt -> bind_param("i", $gameId);
            $stmt -> execute();
            $stmt -> store_result();
            $stmt -> bind_result($maxPlayers, $activePlayers, $money, $players, $serverName, $_SESSION['serverStatus'],$_SESSION['gameTime'], $_SESSION['timeForTour']);
            $alfa = $stmt->num_rows;
            $stmt -> fetch();
            $stmt -> close();
        } else {
            $sql = "SELECT maxPlayers, activePlayer, baseMoney, players, serverName, gameStatus, time, timeForTour FROM game WHERE gameID = ? AND BINARY gamePasscode = BINARY ?";
            $stmt = $connection -> prepare($sql);
            $stmt -> bind_param("is", $gameId, $passcode);
            $stmt -> execute();
            $stmt -> store_result();
            $stmt -> bind_result($maxPlayers, $activePlayers, $money, $players, $serverName, $_SESSION['serverStatus'],$_SESSION['gameTime'], $_SESSION['timeForTour']);
            $alfa = $stmt->num_rows;
            $stmt -> fetch();
            $stmt -> close();
        }  
        if ($_SESSION['serverStatus'] == "2") {
            unset($serverName, $_SESSION['serverStatus'],$_SESSION['serverActivplayers'],$_SESSION['gameTime'], $_SESSION['timeForTour'],$_SESSION['Players']);
            header("Location: ../gameWined/index.php?server=".$gameId);
            mysqli_close($connection);
            exit();
        }
        $_SESSION['Players'] = $players;  
        $players = explode(":",$players);
        for ($i = 0; $i<4; $i++) {
            if ($players[$i] == 0) {
                $players[$i] = $playerID;
                break;
            }
        }
        $pogchamp ="";
        for ($i = 0; $i<4; $i++) {
            if ($i<3) {$pogchamp.=$players[$i].":";} else {$pogchamp.=$players[$i];};
        }
        unset($players);
        $activePlayers++;
        $_SESSION['serverActivplayers']=$activePlayers;
        if ($alfa > 0 && $activePlayers <= $maxPlayers) {
            $sql = "UPDATE game SET players = ?, activePlayer = ? WHERE gameID = ?";
            $stmt = $connection -> prepare($sql);
            $stmt -> bind_param("sii", $pogchamp, $activePlayers, $gameId);
            $stmt -> execute();
            $stmt -> close();
            $sql = 'UPDATE users SET inGame = ? where id = ?';
            $stmt2 = $connection -> prepare($sql);
            $stmt2 -> bind_param("ii", $gameId, $playerID);
            $stmt2 -> execute();
            $stmt2 -> close();
            mysqli_close($connection);
            header("Location: ../queue.php");
        } else {
            unset($serverName, $_SESSION['serverStatus'],$_SESSION['serverActivplayers'],$_SESSION['gameTime'], $_SESSION['timeForTour'],$_SESSION['Players']);
            $_SESSION['error'] = "Nie udało się dołączyć!<br>";
            header("Location: ../gamesList.php");
        }
    }
?>
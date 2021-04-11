<?php
    session_start();
    
    if (!isset($_SESSION['logged']) || !isset($_SESSION['gameId'])) {
        header("Location: ../gameList.php");
       exit();
    }
    $gameId = intval($_SESSION['gameId']);
    $playerID = intval($_SESSION['id']);
    unset($_SESSION['serverName'], $_SESSION['serverStatus'], $_SESSION['serverActivplayers'], $_SESSION['gameId']);
	require_once "../base.php";
	$connection = new mysqli($host, $db_user, $db_passcode, $db_name);
	if ($connection->connect_errno !=0) {
		echo "Error: ".$connection->connection_errno;
	} else {
		$sql = "SELECT gameStatus, activePlayer, players FROM game WHERE gameID = ?";
		$stmt = $connection -> prepare($sql);
		$stmt -> bind_param("i", $gameId);
		$stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($gameStatus, $active, $players);
		$stmt -> fetch();
		$alfa = $stmt->num_rows;
        $stmt -> close();
		if ($alfa = 0 || $gameStatus > 0) {	
            $_SESSION['error'] = "Gra się rozpoczęła albo coś się zepsuło!";
			header("Location: ../gamesList.php");
		} else {
            $players = explode(":",$players);
            for ($i = 0; $i<4; $i++) {
                if ($players[$i] == $playerID) {
                    $players[$i] = "0";
                    break;
                }
            }
            $pogchamp ="";
            for ($i = 0; $i<4; $i++) {
                if ($i<3) {$pogchamp.=$players[$i].":";} else {$pogchamp.=$players[$i];};
            }
            $active--;
            $sql = "UPDATE game SET players = ?, activePlayer = ? WHERE gameID = ?";
            $stmt = $connection -> prepare($sql);
            $stmt -> bind_param("sii", $pogchamp, $active, $gameId);
            $stmt -> execute();
            $stmt -> close();
            $sql = "UPDATE users SET inGame = 0 WHERE id = ?";
            $stmt = $connection -> prepare($sql);
            $stmt -> bind_param("i", $playerID);
            $stmt -> execute();
            $stmt -> close();
            mysqli_close($connection);
            header("Location: ../gamesList.php");
		} 
	}
?>
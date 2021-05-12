<?php 
	session_start();
	if (!isset($_SESSION['logged'])) {
		header("Location: ../index.php");
		exit();
	}
	function passcode($a) {
		if (strlen($a) > 0) {
			return "true";
		} else {
			return "false";
		}
	}
	require_once "../base.php";
	$connection = new mysqli($host,	$db_user, $db_passcode, $db_name);
	if ($connection->connect_errno != 0) {
		echo "Error: ".$connection->connection_errno;
	} else {
		$sql = "";
		if (isset($_REQUEST["q"])) {
			$q =  filter_var($_REQUEST["q"], FILTER_SANITIZE_STRING);
			$sql = "SELECT gameID, serverName, gamePasscode, gameStatus, activePlayer, maxPlayers FROM game where LOWER(serverName) LIKE LOWER(\"{$q}%\") ORDER BY gameStatus ASC";	
		} else {
			$sql = "SELECT gameID, serverName, gamePasscode, gameStatus, activePlayer, maxPlayers FROM game ORDER BY gameStatus ASC";
		}
		$stmt = $connection -> query($sql);
		$gameNum = $stmt->num_rows;
        while($obj = $stmt->fetch_object()){
        	@$serverId.= $obj->gameID.":";
            @$serverName.= $obj->serverName.":";
            @$serverPasscode.= passcode($obj->gamePasscode).":";
            @$serverStatus .= $obj->gameStatus.":";
			@$activePlayer .= $obj->activePlayer.":";
			@$maxPlayer .= $obj->maxPlayers.":";
		}
		$stmt -> close();
		mysqli_close($connection);
		if ($gameNum == 0) {
			echo "Dupa! Brak serwerów!";
		} else {
			echo $serverId.";".$serverName.";".$serverPasscode.";".$serverStatus.";".$activePlayer.";".$maxPlayer;
		}
	}
?>
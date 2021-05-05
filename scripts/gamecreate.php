<?php
    session_start();
	if (!isset($_SESSION['logged'])) {
		session_destroy();
		header("Location: ../index.php");
		exit();
    }
    if (isset($_SESSION['serverName'])) { 
        header("Location: ../gamesList.php");
        exit();
    }
    $name = $_POST['name'];
    $gamePlayer = $_POST['amountOfPlayers'];
    $gameTime = $_POST['amountOftime'];
    $roundTime = $_POST['roundTime'];
    $money = $_POST['amountOfMoney'];
    unset($_POST['name'], $_POST['amountOfPlayers'], $_POST['amountOftime'], $_POST['roundTime'], $_POST['amountOfMoney']);
    $passcodeSet = false;
    $passcode;
    $name = str_replace("\xA0", " ", $name);
    $name = trim($name);
    $allRight = true;
    
    if (strlen($name) < 3 || strlen(trim($name)) < 3 || strlen($name) > 21) {
        $_SESSION['error'] .= "Nazwa za krótka lub za długa!<br>";
        $allRight = false;
    }

    if (isset($_POST['chPasscode'])) {
        $passcode = $_POST['password'];
        unset($_POST['password'],$_POST['chPasscode']);
        if (strlen($passcode) < 3 || strlen($passcode) > 21) {
            $_SESSION['error'] .= "Hasło za krótkie lub za długie!<br>";
            $allRight = false;
            header("Location: ../gameList.php");
            exit();
        } else {
            $passcodeSet = true;

        }
    }
    if ($allRight != true) {
        header("Location: ../gamesList.php");
        exit();
    }
    switch ($roundTime) {
        case "1":
            $roundTime = 30;
        break;
        case "2":
            $roundTime = 45;
        break;
        case "3":
            $roundTime = 60;
        break;
    }
    switch ($money) {
        case "1":
            $money = 1000000;
        break;
        case "2":
            $money = 2000000;
        break;
        case "3":
            $money = 3000000;
        break;
    }
    switch ($gameTime) {
        case "1":
            $gameTime = 30;
        break;
        case "2":
            $gameTime = 45;
        break;
        case "3":
            $gameTime = 60;
        break;
    }
    switch ($gamePlayer) {
        case "2":
            $gamePlayer = 2;
        break;
        case "3":
            $gamePlayer = 3;
        break;
        case "4":
            $gamePlayer = 4;
        break;
    }
	require_once "../base.php";
	$connection = new mysqli($host, $db_user, $db_passcode, $db_name);
	if ($connection->connect_errno !=0) {
		echo "Error: ".$connection->connection_errno;
	} else {
		$sql = "SELECT serverName FROM game WHERE BINARY serverName = BINARY ?";
		$stmt = $connection -> prepare($sql);
		$stmt -> bind_param("s", $name);
		$stmt -> execute();
		$stmt -> store_result();
		$stmt -> fetch();
		$alfa = $stmt->num_rows;
        $stmt -> close();
		if ($alfa > 0) {	
            $_SESSION['error'] .= "Istnieje server o tej nazwie!";
			header("Location: ../gamesList.php");
		} else {
            $PmoneyR = strval($money).":".strval($money).":".strval($money).":".strval($money);
            echo $PmoneyR;
            $players = "0:0:0:0";
            if ($passcodeSet == true) {
                $sql = 'INSERT INTO game(serverName, gamePasscode, gameStatus, activePlayer, time, timeForTour, tour, baseMoney,maxPlayers,players,place,cards,money, whosTour,movesCodes,islands,wealth,logs,bancruit) VALUES (?,?,0,0,?,?,0,?,?,?,"0:0:0:0","0:0:0:0",?,0,"0:0:0:0","0:0:0:0",?,"","0:0:0:0")';
                $stmt = $connection -> prepare($sql);
                $stmt -> bind_param("ssiiiisss", $name, $passcode, $gameTime, $roundTime, $money, $gamePlayer, $players, $PmoneyR, $PmoneyR);
                $stmt -> execute();
                $stmt -> close();
            } else {
                $sql = 'INSERT INTO game(serverName, gameStatus, activePlayer, time, timeForTour, tour, baseMoney,maxPlayers,players,place,cards,money, whosTour,movesCodes,islands,wealth,logs,bancruit) VALUES (?,0,0,?,?,0,?,?,?,"0:0:0:0","0:0:0:0",?,0,"0:0:0:0","0:0:0:0",?,"","0:0:0:0")';
                $stmt = $connection -> prepare($sql);
                $stmt -> bind_param("siiiisss", $name,$gameTime,$roundTime,$money,$gamePlayer,$players,$PmoneyR,$PmoneyR);
                $stmt -> execute();
                $stmt -> close();
            }
            $sql = "SELECT gameID FROM game WHERE BINARY serverName = BINARY ?";
            $stmt = $connection -> prepare($sql);
            $stmt -> bind_param("s", $name);
            $stmt -> execute();
            $stmt -> store_result();
            $stmt -> bind_result($id);
            $stmt -> fetch();
            $stmt -> close();
            mysqli_close($connection);
            if ($passcodeSet == true) {
                header("Location: join.php?p=".$passcode."&q=".$id);
            } else {
                header("Location: join.php?q=".$id);
            }
		} 
	}
?>
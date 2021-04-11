<?php
	session_start();
	if (isset($_SESSION['logged'])) {
		header("Location: ../gamesList.php");
		exit();
	}
	$nick = trim($_POST['nick']);
	$passcode = trim($_POST['passcode']);
	$passcode2 = trim($_POST['passcode2']);
	$mail = trim($_POST['email']);
	unset($_POST['nick'],$_POST['passcode'],$_POST['passcode2'],$_POST['email']);

	$allRight = true;

	if (strlen($nick) < 3) {
		$allRight = false;
		$_SESSION['error'] .= "Nick powinnien być dłuższy!";
	}
	if ($passcode != $passcode2) {
		$allRight = false;
		$_SESSION['error'] .= "Hasła są rużne!";
	}
	if (strlen($passcode) < 3) {
		$allRight = false;
		$_SESSION['error'] .= "Hasło powinno być dłuższe!";
	}
	if (!isset($_POST['ch1'])) {
		$_SESSION['error'] .= "Regulamin nie został zakceptowany!";
		$allRight = false;
	}
	if ($allRight == false) {
		$_SESSION['error'] .= "<br>Nie udało się zarejestrować!";
		header('Location: ../index.php');
		exit();
	}

	require_once "../base.php";
	$connection = new mysqli($host, $db_user, $db_passcode, $db_name);
	if ($connection->connect_errno !=0) {
		echo "Error: ".$connection->connection_errno;
	} else {
		$statistic = "1.1;0:1.2;0:1.3;0:0;0:0;0:0;0";
		$sql = "SELECT nickname, mail FROM users WHERE BINARY nickname = ? OR BINARY mail = ?";
		$stmt = $connection -> prepare($sql);
		$stmt -> bind_param("ss", $nick, $mail);
		$stmt -> execute();
		$stmt -> store_result();
		$stmt -> fetch();
		$alfa = $stmt->num_rows;
		$stmt -> close();
		if ($alfa > 0) {	
			$_SESSION['error'] = "Istnieje użytkownik o tym nicku lub emailu!";
			mysqli_close($connection);
			header("Location: ../index.php");
		} else {
			$passcode = password_hash($passcode, PASSWORD_DEFAULT);
			$sql = "INSERT INTO users (nickname, passcode, mail, statistic, theme, inGame) VALUES (?,?,?,?,0,0)";
			$stmt = $connection -> prepare($sql);
			$stmt -> bind_param("ssss", $nick, $passcode,$mail,$statistic);
			$stmt -> execute();
			$stmt -> fetch();
			$stmt -> close();
			mysqli_close($connection);
			$_SESSION['error'] = "Udało się zarejestrować!!!";
			header("Location: ../index.php");
		} 

	}

?>
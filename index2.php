<?php
	session_start();
	if (isset($_SESSION['logged'])) {
		header("Location: gamesList.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Strona główna</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<script type="text/javascript" src="scripts/app.js"></script>
</head>
<body>
	<div>
		<header>
			Zaloguj lub zarejestruj się do darmowej gry ULANOTOPI!!!
		</header>
		<div id="gridBox">
			<div id="blueBox">
				<div id="greyBox">
					<div id="textHolder">	
						<div>
							<button id="RegInB" onclick="log()">Logowanie</button>
							<button id="RegInB" onclick="reg()">Rejestracja</button>
							<a href="info.php"><button>O stronie</button></a>
						</div>
						<div id="form">
							<div id="changeble">
								<form method="post" action="scripts/login.php">
									Nick: <input type="text" name="nick" ><br><br>
									Hasło: <input type="password" name="passcode"><br><br>
									<button>Zaloguj</button>
								</form>
							</div>
							<div>
								<?php
									if (isset($_SESSION['error'])) {
										echo $_SESSION['error'];
										unset($_SESSION['error']);
									}
								?>
							</div>
						</div>
					</div>
				<div>
			</div>
		</div>
	</div>
</body>
</html>
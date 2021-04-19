<?php
	session_start();
	if (!isset($_SESSION['logged'])) {
		header("Location: index.php");
		exit();
	}
	if (!isset($_SESSION['serverName'])) {
		require_once "base.php";
		$connection = new mysqli($host,	$db_user, $db_passcode, $db_name);
		if ($connection->connect_errno != 0) {
			echo "Error: ".$connection->connection_errno;
		} else {
			$sql = "SELECT inGame FROM users WHERE id = ?";
			$stmt = $connection -> prepare($sql);
			$stmt -> bind_param("i", $_SESSION['id']);
			$stmt -> execute();
			$stmt -> store_result();
			$stmt -> bind_result($games);
			$stmt -> fetch();
			$stmt -> close();
			if ($games > 0) {
				$_SESSION['gameId'] = $games;
				$sql = "SELECT maxPlayers, activePlayer, baseMoney, players, serverName, gameStatus, time, timeForTour FROM game WHERE gameID = ?";
				$stmt = $connection -> prepare($sql);
				$stmt -> bind_param("i", $games);
				$stmt -> execute();
				$stmt -> store_result();
				$stmt -> bind_result($_SESSION['maxPlayers'], $_SESSION['serverActivplayers'], $_SESSION['money'], $_SESSION['Players'], $_SESSION['serverName'], $_SESSION['serverStatus'],$_SESSION['gameTime'], $_SESSION['timeForTour']);
				$stmt -> fetch();
				$stmt -> close();
				mysqli_close($connection);
				header("Location: queue.php");
			} else {
				mysqli_close($connection);
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista gier</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		if ($_SESSION['theme'] == 0) {
			echo '<link rel="stylesheet" type="text/css" href="styles/style2.css">';
		} else {
			echo '<link rel="stylesheet" type="text/css" href="style2L.css">';
		}
	?>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
	<script type="text/javascript" src="scripts/app.js" defer></script>
	<script type="text/javascript">
		function gameJoin(a,b) {
			<?php
				if (!isset($_SESSION['serverStatus'])) {
					echo '
					var href = window.location.href.slice(0, -13);
					if (b==true) {
						var pac = prompt("Podaj hasło jeżeli, jeżeli nie ma nic nie wpisuj");
						if (pac.length > 3) {
							window.location.replace(href+"join.php?q="+a+"&p="+pac);
						}
					} else {
						window.location.replace(href+"scripts/join.php?q="+a);
					}'; 
				} else {
					echo 'return;';
				}
			?>
		}
	</script>
</head>
<body>
	<?php 
		if (isset($_SESSION['serverName'])) {
			echo '
			<div id="serverStatusBlock" style="display: flex;">
				<span style="padding: 1em;display: flex;">Nazwa gry:&nbsp;<div id="serverName"></div></span>
				<span style="padding: 1em;display: flex;">Status gry:&nbsp;<div id="serverStatus"></div></span>
				<span style="padding: 1em;display: flex;">Liczba graczy:&nbsp;<div id="players"></div> </span>
				<span style="padding: 1em;display: flex;"><a href="queue.php"><button>Powrót</button></a></span>
				<span style="padding: 1em;display: flex;"><a href="scripts/leaveGame.php"><button>Wyjście z gry</button></a></span>
			</div>
			<script type="text/javascript" defer>
				var status = '.$_SESSION['serverStatus'].';
				var name = "'.$_SESSION['serverName'].'";
				var activePlayer = '.$_SESSION['serverActivplayers'].';
				var maxplayer = '.$_SESSION['maxPlayers'].';	
				function loadGameInfo() {
					var xmlrequest = new XMLHttpRequest();
					xmlrequest.onreadystatechange = function () {
						if (this.readyState == 4 && this.status == 200) {
							var res = new Date().getTime()-pingS;
							console.log("ping: "+res);
							var data = this.responseText.split(";");
							doDataThing(data);
							
						}
					}
					xmlrequest.open("GET", "gameInfoLoad.php", true);
					xmlrequest.send();
					var pingS = new Date().getTime();
				}
				var interval = setInterval(loadGameInfo, 700);
				document.getElementById("serverName").innerHTML = name;
				document.getElementById("serverStatus").innerHTML =  "Gra nie rozpoczęta";
				document.getElementById("players").innerHTML = activePlayer+"/"+maxplayer;
				function doDataThing(data) {
					if (data[1] != "0") {
						var href = window.location.href.slice(0, -13);
						window.location.href = href+"gameBoard/index.php";
					}
					document.getElementById("players").innerHTML =  data[2]+"/"+maxplayer;
				}
			</script>';
		}
	?>
	<div class="whiteBox"></div>
	<header>
		<a href="scripts/logout.php"><button>Wyloguj</button></a>
		<div id="profil-ico">
			<a href="profile.php" id="href">
				<img class="png" src="ico/icons8-user-64.png">
			</a>
		</div>
	</header>
	<main class="gameList">
		<aside> 
			<div style="padding-top: 10%;">Gry online: <span id="onlineGames">0</span></div><br>
			<div style="padding-top: 2%;"><button onclick="loadGames()">Odśwież</button></div>
			<br><br>
			<div>Wyszukaj gry:<br><br>
				<input type="text" name="gamesSerch" onchange="loadGames(this)">
			</div>
			<div class="error">				
				<?php
					if (isset($_SESSION['error'])) {
						echo $_SESSION['error'];
						unset($_SESSION['error']);
					}
				?>
			</div>
		</aside>
		<div class="games">
			<nav>
				<div class="option">Nazwa gry</div>
				<div class="option">Hasło</div>
				<div class="option">Liczba graczy</div>
				<div class="option">Status</div>
				<div class="option"></div>
				<button onclick="toGameCreate()" class="page right">Stwórz grę</button>
			</nav>
			<div id="searchResult">
			</div>
		</div>
	</main>
	<main class="regGame">
		<button onclick="toGameList()" class="page left">Powrót</button>
		<form action="scripts/gamecreate.php" method="post" id="form">
			<input type="name" name="name" placeholder="Nazwa"><br>
			Hasło: <input type="checkbox" name="chPasscode" id="chPasscode" onclick="chChange()">
			<span id="littlePlace"></span><br>
			<label><input type="radio" value="2" name="amountOfPlayers"><div class="selectp"><i class="fas fa-user-friends"></i><br>2 Graczy</div></label>
			<label><input type="radio" value="3" name="amountOfPlayers"><div class="selectp"><i class="fas fa-users"></i><br>3 Graczy</div></label>
			<label><input type="radio" value="4" name="amountOfPlayers" checked><div class="selectp"><img src="ico/users4.png"><br>4 Graczy</div></label><br>
			<label><input type="radio" value="1" name="roundTime"><div class="selectp">30s</div></label>
			<label><input type="radio" value="2" name="roundTime" checked><div class="selectp">45s</div></label>
			<label><input type="radio" value="3" name="roundTime"><div class="selectp">60s</div></label><br>
			<label><input type="radio" value="1" name="amountOftime"><div class="selectp">30min</div></label>
			<label><input type="radio" value="2" name="amountOftime"><div class="selectp">45min</div></label>
			<label><input type="radio" value="3" name="amountOftime" checked><div class="selectp">60min</div></label><br>
			<label><input type="radio" value="1" name="amountOfMoney"><div class="selectp">1mln</div></label>
			<label><input type="radio" value="2" name="amountOfMoney" checked><div class="selectp">2mln</div></label>
			<label><input type="radio" value="3" name="amountOfMoney"><div class="selectp">3mln</div></label><br>
			<div id="tuBedeTwojeProblemy">
				<?php
					if (isset($_SESSION['error'])) {
						echo $_SESSION['error'];
						unset($_SESSION['error']);
					}
				?>
			</div>
		</form><br>
		<button onclick="checkForm()" class="submit">Prześlij</button>
	</main>
	<script>
		function toGameCreate() {
			document.querySelector('.whiteBox').classList.add('toGameCreate');
			setTimeout(() => { 
				document.querySelector('.gameList').style.visibility = 'hidden';
				document.querySelector('.regGame').style.visibility = 'visible';
			}, 500);
			setTimeout(() => {
				document.querySelector('.whiteBox').classList.remove('toGameCreate');
			}, 1000);
		}

		function toGameList() {
			document.querySelector('.whiteBox').classList.add('toGameList');
			setTimeout(() => { 
				document.querySelector('.gameList').style.visibility = 'visible';
				document.querySelector('.regGame').style.visibility = 'hidden';
			}, 500);
			setTimeout(() => {
				document.querySelector('.whiteBox').classList.remove('toGameList');
			}, 1000);
		}
	</script>
</body>
</html>
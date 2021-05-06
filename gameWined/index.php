<?php
    session_start();
	if (isset($_SESSION['money'])) {
		unset($_SESSION['money'],$_SESSION['gameId'],$_SESSION['maxPlayers'],$_SESSION['serverActivplayers'],$_SESSION['Players'],$_SESSION['serverName'],$_SESSION['serverStatus'],$_SESSION['gameTime'],$_SESSION['timeForTour']);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Poczekalnia gry zakończonej gry</title>
		<link rel="stylesheet" type="text/css" href="../styles/queue.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script>
			var serverId = <?php echo $_GET['server'] ?>;
		</script>
		<script type="text/javascript" src="app.js" defer></script>
</head>
<body>
	<header>
		<header>
        <a href="gamesList.php" class="logo">Ulanopoli</a>
        <?php 
        if (isset($_SESSION["error"])) {
                echo $_SESSION["error"]; 
                unset($_SESSION["error"]);
            }
        ?>
        <div id="profil-ico" class="avatar">
			<a href="../profile.php" id="href">
				<img class="png" src="../ico/icons8-user-64.png">
			</a>
		</div>
	</header>
	<main>
		<div class="center">
			<span id="otherPlayers">

			</span>
		</div>
	</main>
	<aside>
		<span>Gra: <span id="gameName"></span></span><br>
		<span>Status: <span id="gameStatus">Zakończona</span></span><br><br>
		<span><span id="gameWinner"></span></span><br>
		<span>Tur: <span id="gameRounds"></span></span><br>
		
		<span>Ustawienia gry: <span id="gameSettings"></span></span><br>
		<span>Liczba graczy: <span id="gamePlayers"></span></span><br>
		<span>Czas gry: <span id="gameTime"></span>min.</span><br>
		<span>Czas na turę: <span id="gameTimeForTour"></span>sec.</span><br>
		<span>Podstawowy social: <span id="gameStartMoney"></span>. </span><br><br>
		<span id="Gracz1"> </span>
		<span id="Gracz2"> </span>
		<span id="Gracz3"> </span>
		<span id="Gracz4"> </span>
		<span style="padding: 1em;display: flex; text-align:center;"><a href="../"><button>Wyjście z gry</button></a></span><br>
	</aside>
</body>
</html>

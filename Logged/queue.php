<?php
    session_start();
        if (!isset($_SESSION['logged']) || !isset($_SESSION['serverName'])) {
            header("Location: index.php");
            exit();
        }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Poczekalnia gry: <?php echo $_SESSION['serverName'];?></title>
		<link rel="stylesheet" type="text/css" href="styles/queue.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script>
			var idMy = <?php echo $_SESSION['id'] ?>;
		</script>
		<script type="text/javascript" src="scripts/queue.js" defer></script>
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
			<a href="profile.php" id="href">
				<img class="png" src="ico/icons8-user-64.png">
			</a>
		</div>
	</header>
	<main>
		<div class="center">
			<span id="meHolder">

			</span>
			<span id="otherPlayers">

			</span>
		</div>
	</main>
	<aside>
		<span>Gra: </span><br>
		<span>Status: <span id="gameStatus"></span></span><br><br>
		<span>Ustawienia gry: <span id="gameSettings"></span></span><br>
		<span>Czas gry: <span id="gameTime"></span>min.</span><br>
		<span>Czas na ture: <span id="gameTimeForTour"></span>sec.</span><br>
		<span>Podstawowy social: <span id="gameStartMoney"></span>. </span><br><br>
		<span id="startButt" style="padding: 1em;display: flex; text-align:center;"> </span>
		<span style="padding: 1em;display: flex; text-align:center;"><a href="scripts/leaveGame.php"><button>Wyjście z gry</button></a></span><br>
	</aside>
</body>
</html>

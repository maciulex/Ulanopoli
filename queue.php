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
		<?php 
			echo '
			<script type="text/javascript" defer>
				var lastData =  ["", "0", "0","0:0:0:0"];
				var maxplayer = '.$_SESSION['maxPlayers'].';
				var di = '.$_SESSION['id'].';
				var IDZ = "'.$_SESSION["gameStatsPlayer"].'";
				var moneyC = "'.$_SESSION["money"].'";
			</script>';
		?>
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
			<section>
            <?php 
                if (file_exists("avatars/".$_SESSION["id"].".jpg")) {
                    echo '<img src="avatars/'.$_SESSION["id"].'.jpg" class="profilePicture" alt="profilePicture">';
                } else {
                    if ($_SESSION['theme'] == 0) {
                        echo '<img src="avatars/def.jpg" class="profilePicture" alt="profilePicture">';
                    } else {
                        echo '<img src="avatars/defL.jpg" class="profilePicture" alt="profilePicture">';
                    }
                }
            ?>
				<div class="statisticsContainer">
					<div class="profileInfo">
						<div class="nickname"><span id="nick<?php echo $_SESSION["id"] ?>"><?php echo $_SESSION['nick'];?></span></div>
					</div>
					<div class="statistics">
						<div class="stats1"><span id="stats1<?php echo $_SESSION["id"] ?>"></span></div>
						<div class="stats2"><span id="stats2<?php echo $_SESSION["id"] ?>"></span></div>
						<div class="stats3"><span id="stats3<?php echo $_SESSION["id"] ?>"></span></div>
					</div>
				</div>
			</section>
			<span id="sryBroIKnowButSpanIsIdealForThat">

			</span>
		</div>
	</main>
	<aside>
		<span>Gra: <?php echo $_SESSION['serverName']; ?></span><br>
		<span>Status: <span id="status"><?php echo 'Oczekiwanie na graczy ('.$_SESSION['serverActivplayers'].'/'.$_SESSION['maxPlayers'].').' ?></span></span><br><br>
		<span>Ustawienia gry:</span><br>
		<span>Czas gry: <?php echo $_SESSION['gameTime']; ?>min.</span><br>
		<span>Czas na ture: <?php echo $_SESSION['timeForTour']; ?>sec.</span><br>
		<span>Podstawowy social: <span id="social"></span>. </span><br><br>
		<span id="startButt" style="padding: 1em;display: flex; text-align:center;"> </span>
		<span style="padding: 1em;display: flex; text-align:center;"><a href="scripts/leaveGame.php"><button>Wyjście z gry</button></a></span><br>
	</aside>
</body>
</html>
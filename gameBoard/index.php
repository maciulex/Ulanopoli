<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Prototyp planszy</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Cabin:wdth@90&display=swap" rel="stylesheet">
	<meta charset="utf-8">
	<script>
		var nick = "<?php echo $_SESSION['nick']; ?>";
	</script>
	<script src="app.js" defer></script>
</head>
<body>
	<?php
		echo '<span id="idk">';
		include "../scripts/gameInfoLoad.php";
		echo "</span>";
	    if (!isset($_SESSION['logged']) || !isset($_SESSION['serverName']) || $_SESSION['serverStatus'] == 0) {
	        header("Location: ../index.php");
	        exit();
	    }
	?>
	<div style="width: 30vh;height: 20vh;background-color:grey; margin-top: 20vh;">
		<?php echo $_SESSION['nick']?><br>
		Aktualny czas: <?php echo date('H:i:s');?><br>
		Czas do końca gry: <span id="gameTimeEnd"></span><br>
		<span id="throwButton"></span><br>
		<span id="throwResult"></span>
		<span id="throwResultName"></span>
		<div id="buyFild"> 
			
		</div>
	</div>
	<div style="width: 35vh;height: 20vh;background-color:grey; margin-top: 15vh;">
		<div id="buyBlock">
			
		</div>
		<div id="sellOrFildInfo">
			
		</div>
	</div>
	<div id="gamePlaceHolder">
		<div class="players">
			<div id="player1">
				<div class="playerIn">
					<div class="playerName">
						PlaceHolder 1
					</div>
					<div class="money">
						<div class="moneyAmmount">
							<div>$</div>
							<div class="moneyNumber">500k</div>
						</div>
					</div>
				</div>
			</div>
			<div id="player2">
				<div class="playerIn">
					<div class="playerName">
						Computer 1
					</div>
					<div class="money">
						<div class="moneyAmmount">
							<div>$</div>
							<div class="moneyNumber">500k</div>
						</div>
					</div>
				</div>
			</div>
			<div id="player3">
				<div class="playerIn">
					<div class="playerName">
						Computer 2				
					</div>
					<div class="money">
						<div class="moneyAmmount">
							<div>$</div>
							<div class="moneyNumber">500k</div>
						</div>
					</div>
				</div>
			</div>
			<div id="player4">
				<div class="playerIn">
					<div class="playerName">
						Computer 3
					</div>
					<div class="money">
						<div class="moneyAmmount">
							<div>$</div>
							<div class="moneyNumber">500k</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="gameBoard">
			<div id="gamebordBack">
			<div class="gameClusters">
				<div class="cornerBlock">
					<div class="cityBlock">
						<div class="cityName">
							<div id="N16">MISTRZOSTWA<br> ŚWIATA</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity16">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L17">0</div>
						</div>
						<div class="cityName">
							<div id="N17">LONDYN</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C17">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity17">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock cityBlockISLA">
					<div>
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L18">0</div>
						</div>
						<div class="cityName">
							<div id="N18">DUBAJ</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C18">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity18">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L19">0</div>
						</div>
						<div class="cityName">
							<div id="N19">SYDNEY</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C19">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity19">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock chance">
					<div>SZANSA</div>
					<div class="playersInCity">
						<div id="playerInCity20">
							
						</div>
					</div>
				</div>
				<div class="normalBlock colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L21">0</div>
						</div>
						<div class="cityName">
							<div id="N21">CHICAGO</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C21">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity21">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L22">0</div>
						</div>
						<div class="cityName">
							<div id="N22">LAS VEGAS</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C22">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity22">
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L23">0</div>
						</div>
						<div class="cityName">
							<div id="N23">NOWY JORK</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C23">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity23">
								<br>
							</div>
						</div>
					</div>
				</div>

				<div class="cornerBlock">
					<div class="cityBlock">
						<div class="cityName">
							<div id="N24">PODRÓŻ</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity24">
								<br>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="gameClusters">
				<div class="normalBlockM colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvlBlock">
							<div class="cityLvl">
								<div class="lvlN">LVL:</div>
								<div id="L15">0</div>
							</div>
							<div class="cityName">
								<div id="N15">BERLIN</div>
							</div>
							<div class="rentalCostM rentalCost">
								Koszt:
								<div id="C15">0</div>
							</div>
							<div class="playersInCity">
								<div id="playerInCity15">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			<div class="normalBlockM  cityBlockISLA right">
					<div class="cityBlock">
						<div class="cityLvlBlock">
							<div class="cityLvl">
								<div class="lvlN">LVL:</div>
								<div id="L25">0</div>
							</div>
							<div class="cityName">
								<div id="N25">NICEA</div>
							</div>
							<div class="rentalCostM rentalCost">
								Koszt:
								<div id="C25">0</div>
							</div>
							<div class="playersInCity">
								<div id="playerInCity25">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="gameClusters">
				<div class="normalBlockM  cityBlockISLA">
					<div class="cityBlock">
						<div class="cityLvlBlock">
							<div class="cityLvl">
								<div class="lvlN">LVL:</div>
								<div id="L14">0</div>
							</div>
							<div class="cityName">
								<div id="N14">CYPR</div>
							</div>
							<div class="rentalCostM rentalCost">
								Koszt:
								<div id="C14">0</div>
							</div>
							<div class="playersInCity">
								<div id="playerInCity14">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlockM right colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvlBlock">
							<div class="cityLvl">
								<div class="lvlN">LVL:</div>
								<div id="L26">0</div>
							</div>
							<div class="cityName">
								<div id="N26">LYON</div>
							</div>
							<div class="rentalCostM rentalCost">
								Koszt:
								<div id="C26">0</div>
							</div>
							<div class="playersInCity">
								<div id="playerInCity26">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="gameClusters">
				<div class="normalBlockM colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvlBlock">
							<div class="cityLvl">
								<div class="lvlN">LVL:</div>
								<div id="L13">0</div>
							</div>
							<div class="cityName">
								<div id="N13">HAMBURG</div>
							</div>
							<div class="rentalCostM rentalCost">
								Koszt:
								<div id="C13">0</div>
							</div>
							<div class="playersInCity">
								<div id="playerInCity13">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlockM right colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvlBlock">
							<div class="cityLvl">
								<div class="lvlN">LVL:</div>
								<div id="L27">0</div>
							</div>
							<div class="cityName">
								<div id="N27">PARYŻ</div>
							</div>
							<div class="rentalCostM rentalCost">
								Koszt:
								<div id="C27">0</div>
							</div>
							<div class="playersInCity">
								<div id="playerInCity27">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="gameClusters">
				<div class="normalBlockM chance">
					<div>SZANSA</div>
					<div class="playersInCity">
						<div id="playerInCity12">
							
						</div>
					</div>
				</div>
				<div class="normalBlockM right chance">
					<div>SZANSA</div>
					<div class="playersInCity">
						<div id="playerInCity28">
							
						</div>
					</div>
				</div>
			</div>
			<div class="gameClusters">
				<div class="normalBlockM colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvlBlock">
							<div class="cityLvl">
								<div class="lvlN">LVL:</div>
								<div id="L11">0</div>
							</div>
							<div class="cityName">
								<div id="N11">RZYM</div>
							</div>
							<div class="rentalCostM rentalCost">
								Koszt:
								<div id="C11">0</div>
							</div>
							<div class="playersInCity">
								<div id="playerInCity11">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlockM right colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvlBlock">
							<div class="cityLvl">
								<div class="lvlN">LVL:</div>
								<div id="L29">0</div>
							</div>
							<div class="cityName">
								<div id="N29">KRAKÓW</div>
							</div>
							<div class="rentalCostM rentalCost">
								Koszt:
								<div id="C29">0</div>
							</div>
							<div class="playersInCity">
								<div id="playerInCity29">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="gameClusters">
				<div class="normalBlockM colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvlBlock">
							<div class="cityLvl">
								<div class="lvlN">LVL:</div>
								<div id="L10">0</div>
							</div>
							<div class="cityName">
								<div id="N10">MEDIOLAN</div>
							</div>
							<div class="rentalCostM rentalCost">
								Koszt:
								<div id="C10">0</div>
							</div>
							<div class="playersInCity">
								<div id="playerInCity10">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlockM right chance">
					<div>PODATEK</div>
					<div class="playersInCity">
						<div id="playerInCity30">
							
						</div>
					</div>
				</div>
			</div>
			<div class="gameClusters">
				<div class="normalBlockM colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvlBlock">
							<div class="cityLvl">
								<div class="lvlN">LVL:</div>
								<div id="L9">0</div>
							</div>
							<div class="cityName">
								<div id="N9">WENECJA</div>
							</div>
							<div class="rentalCostM rentalCost">
								Koszt:
								<div id="C9">0</div>
							</div>
							<div class="playersInCity">
								<div id="playerInCity9">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlockM right colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvlBlock">
							<div class="cityLvl">
								<div class="lvlN">LVL:</div>
								<div id="L31">0</div>
							</div>
							<div class="cityName">
								<div id="N31">WARSZAWA</div>
							</div>
							<div class="rentalCostM rentalCost">
								Koszt:
								<div id="C31">0</div>
							</div>
							<div class="playersInCity">
								<div id="playerInCity31">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="gameClusters">
				<div class="cornerBlock">
					<div id="startBlock">
						Bezludna<br> Wyspa
					</div>
					<div class="playersInCity">
						<div id="playerInCity8">
							<br>
						</div>
					</div>
				</div>
				<div class="normalBlock colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L7">0</div>
						</div>
						<div class="cityName">
							<div id="N7">SHANGHAI</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C7">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity7">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L6">0</div>
						</div>
						<div class="cityName">
							<div id="N6">PEKIN</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C6">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity6">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L5">0</div>
						</div>
						<div class="cityName">
							<div id="N5">HONGKONG</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C5">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity5">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock cityBlockISLA">
					<div>
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L4">0</div>
						</div>
						<div class="cityName">
							<div id="N4">BALI</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C4">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity4">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L3">0</div>
						</div>
						<div class="cityName">
							<div id="N3">MADRID</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C3">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity3">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L2">0</div>
						</div>
						<div class="cityName">
							<div id="N2">SEVILLA</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C2">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity2">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="normalBlock colorOfThisBlock">
					<div class="cityBlock">
						<div class="cityLvl">
							<div class="lvlN">LVL: </div>
							<div id="L1">0</div>
						</div>
						<div class="cityName">
							<div id="N1">GRENADA</div>
						</div>
						<div class="rentalCost">
							Koszt:
							<div id="C1">0</div>
						</div>
						<div class="playersInCity">
							<div id="playerInCity1">
								<br>
							</div>
						</div>
					</div>
				</div>
				<div class="cornerBlock">
					<div id="startBlock">
						Start
						<div class="playersInCity">
							<div id="playerInCity0">
								<span id="PlayerB0"></span>
								<span id="PlayerB1"></span>
								<span id="PlayerB2"></span>
								<span id="PlayerB3"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</body>
</html>
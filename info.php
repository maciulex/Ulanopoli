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
	<script type="text/javascript" src="scripts/info.js"></script>
</head>
<body>
	<div>
		<header>
			Zaloguj lub zarejestruj się do darmowej gry ULANOTOPI!!!
		</header>
		<div id="gridBox">
			<div id="blueBox">
				<div id="greyBox" style = "width: 95%; height: 90%">
					<div id="textHolder">	
						<div>
							<button class="RegInB" onclick="about()">O stronie</button>
							<button class="RegInB" onclick="programmers()">Programiści</button>
							<button onclick="bugs()" class="RegInB">Błędy</button>
							<a href="index.php"><button>Strona główna</button></a>

						</div>
						<div id="form">
							<div id="changeble">
                                <h1>O stronie<h1>
                                <span>
                                    Witaj cieszę się że chcesz poświęcić chwilkę by dowiedzieć się więcej o tym projekcie.
                                    Jest to prosta gra, nic wyłamującego się poza już istniejące schematy.
                                    Polega na oto zaskoczenie byciu najlepszym.
                                    W skrócie twoim celem jest zdobycie jak najwięcej pieniędzy i budynków.
                                    Można wygrać przez eliminacje czyli doprowadzić do stanu gdzie tylko ty masz i pieniądze i budynki,
                                    lub poprzez monopole ta droga wymaga zajęcia wszystkich możliwych pól w jednej lini (monopol liniowy)
                                    //każde pole ma poziomy 1-5 gdzię 5'ego nie można odkupić od innego gracza tak zwany Hotel.
                                    poprzez zdobycie 3 monopoli jeden monopol polega na zajęciu wszystkich miast które pochodzą z tego samego kraju.
                                    lub poprzez zajęcie wszystkich (4) wysp problem polega na tym że wysp wraz z hotelami nie można odkupić
                                    Na planszy położone są pola specjalne jak podróż/szansa/mistrzostwa świata.
                                    Jest to darmowa prosta gra dla 2-4 graczy.
                                </span>
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
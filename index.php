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
	<meta name="description" content="Witaj cieszę się że chcesz poświęcić chwilkę by dowiedzieć się więcej o tym projekcie.
        Jest to prosta gra, nic wyłamującego się poza już istniejące schematy.
        Polega na oto zaskoczenie byciu najlepszym.
        W skrócie twoim celem jest zdobycie jak najwięcej pieniędzy i budynków.
        Można wygrać przez eliminacje czyli doprowadzić do stanu gdzie tylko ty masz i pieniądze i budynki,
        lub poprzez monopole ta droga wymaga zajęcia wszystkich możliwych pól w jednej lini (monopol liniowy)
        //każde pole ma poziomy 1-5 gdzię 5'ego nie można odkupić od innego gracza tak zwany Hotel.
        poprzez zdobycie 3 monopoli jeden monopol polega na zajęciu wszystkich miast które pochodzą z tego samego kraju.
        lub poprzez zajęcie wszystkich (4) wysp problem polega na tym że wysp wraz z hotelami nie można odkupić
        Na planszy położone są pola specjalne jak podróż/szansa/mistrzostwa świata.
        Jest to darmowa prosta gra dla 2-4 graczy. Gra planszowa dla 2-4 graczy w kupowanie i handel polami gry, stawianie na nich domów i hoteli, licytacje, podatki itp; występują karty szansy i ryzyka, dwie kostki do gry Cechy i opcje: granie na żywo, pokoje gier, rankingi, rozbudowane statystyki, profile, kontakty, prywatne wiadomości, zapisy gier, obsługa urządzeń mobilnych">
    <meta name="keywords" content="gra, multiplayer, 2-4 graczy, online, monopol, ulanopoli, planszówka, gra na lekcje, darmowa gra, fajna gra, wielu graczy, krótka gra, gra online, gra wieloosobowa, gra z znajomymi">
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
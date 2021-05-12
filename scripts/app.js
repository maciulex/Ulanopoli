function log() {
	document.getElementById("blueBox").style.height = "110%";
	document.getElementById("greyBox").style.width = "60%";
	document.getElementById("changeble").innerHTML = "<form method=\"post\" action=\"scripts/login.php\">Nick: <input type=\"text\" name=\"nick\"><br><br>Hasło: <input type=\"password\" name=\"passcode\"><br><br><button>Zaloguj</button></form>";
}
function reg() {
	document.getElementById("blueBox").style.height = "115%";
	document.getElementById("greyBox").style.width = "70%";
	document.getElementById("changeble").innerHTML = "<form method=\"post\" action=\"scripts/register.php\">Nick: <input type=\"text\" name=\"nick\"><br><br>email: <input type=\"email\" name=\"email\"><br><span style=\"font-size: 15px;\">*email nie potrzebny do rejestracji. I nie daje żadnej korzyści(na razie).</span><br><br>Hasło: <input type=\"password\" name=\"passcode\"><br><br>Powtórz Hasło: <input type=\"password\" name=\"passcode2\"><br><br>Akceptuje <a href=\"\" target=\"blank\">regulamin</a>: <input type=\"checkbox\" name=\"ch1\"><br><br><button>Zarejestruj</button></form>"
}

var passCheckStatus = false;
function loadGames(a) {
	var xmlrequest = new XMLHttpRequest();
	xmlrequest.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var res = new Date().getTime()-pingS;
			console.log("czas ładowania gier: "+res);
			var data = this.responseText.split(";");
			loadData(data);
		}
	}
	if (a == undefined) {
		xmlrequest.open("GET", "scripts/gameListLoad.php", true);
	} else {
		xmlrequest.open("GET", "scripts/gameListLoad.php?q="+a.value, true);
	}
	var pingS = new Date().getTime();
	xmlrequest.send();
}
function Beauty(a,b) {
	switch (b) {
		case 1:
			if (a == true || a == "true") {
				return "<i class=\"fas fa-lock\"></i>";				
			} else {
				return "<i class=\"fas fa-lock-open\"></i>";				
			}
		break;
		case 2:
			if (a == "") {
				return 0;			
			} else {
				return a;				
			}
		break;
		case 3:
			switch (a) {
				case "0":
					return "Nie rozpączęte";			
				break;
				case "1":
					return "Rozpączęte";				
				break;
				case "2":
					return "Zakończone";
				break;
			}
		break;
	}
	return;
}
function loadData(data) {
	var resultPlace = document.getElementById("searchResult");
	if (data[0] == "Dupa! Brak serwerów!") {
		resultPlace.innerHTML = data;
	} else {
		var id = data[0].split(":"), serverName = data[1].split(":"), passcode = data[2].split(":"), status = data[3].split(":"), players = data[4].split(":"), maxPlayers = data[5].split(":");
		document.getElementById("searchResult").innerHTML = "";
		document.getElementById("onlineGames").innerHTML = id.length-1;
		for (var i = 0; i<id.length-1;i++) {
			resultPlace.innerHTML += `<section><div class=\"option\">${serverName[i]}</div><div class=\"option\">${Beauty(passcode[i],1)}</div><div class=\"option\">${Beauty(players[i],2)+"/"+Beauty(maxPlayers[i],2)}</div><div class=\"option\">${Beauty(status[i],3)}</div><div class=\"option\" id=\"test\"><button onclick=\"gameJoin(${id[i]},${passcode[i]})\">Dołącz</button></div></section>`
		}
	}
	return;
}

function checkForm() {
	var place = document.getElementById("tuBedeTwojeProblemy");
	var allRight = true;

	place.innerHTML = "";
	var iN = document.forms["form"]["name"].value

	if (iN.length < 3 || iN.length > 21) {
		allRight = false;
		place.innerHTML += "Nazwa serwera jest za krótka lub długa!<br>";
	}

	if (passCheckStatus == true) {
		var iP = document.forms["form"]["password"].value;
		if (iP.length < 3 || iP.length > 21) {
			allRight = false;
			place.innerHTML += "Hasło serwera jest za krótkie lub długie!";
		}
	}
	if (allRight == true) {
		place.innerHTML = "";
		document.getElementById("form").submit();
	}
}
function chChange() {
	var place = document.getElementById("littlePlace");
	if (passCheckStatus == false) {
		passCheckStatus = true;
		place.innerHTML = "<input type=\"text\" name=\"password\" id=\"password\">";
	} else {
		passCheckStatus = false;
		place.innerHTML = "";
	}
}
loadGames();
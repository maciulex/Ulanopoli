function loadGamers(data2) {
    var xmlrequest = new XMLHttpRequest();
    xmlrequest.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            document.getElementById("sryBroIKnowButSpanIsIdealForThat").innerHTML = "";
            if (data != null && data != "") { 
                drawPlayers(data);	
            } else {
                makeColors(lastData[3]);
            }
        }
    }
    xmlrequest.open("GET", "scripts/playersQueueInfo.php?q="+data2, true);
    xmlrequest.send();
    function drawPlayers(data) {
        var players = data.split("::");
        for (var i = 0; i < players.length; i++) {
            var player = players[i].split(";;");
            var morePlayer = player[0].split("..");
            var id = morePlayer[0];
            var nicks = morePlayer[1];
            var stats = player[1];
            goWithBlock(id,nicks,i);
            ifEgzist(id);
            makeStat(stats, id);
        }
        makeColors(lastData[3]);
    }
    function ifEgzist(id) {
        var xmlrequest = new XMLHttpRequest();
        xmlrequest.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                if (data == "false") {
                    document.getElementById("profileIMG"+id).innerHTML = "<img src=\"avatars/def.jpg\">";
                } else {
                    document.getElementById("profileIMG"+id).innerHTML = "<img src=\"avatars/"+id+".jpg\">";
                }	
            }
        }
        xmlrequest.open("GET", "scripts/playersQueueInfo.php?d="+id, true);
        xmlrequest.send();	
    }
    function goWithBlock(id,nicks,s) {
        document.getElementById("sryBroIKnowButSpanIsIdealForThat").innerHTML += "<section><span id=\"profileIMG"+id+"\"></span><div class=\"statisticsContainer\"><div class=\"profileInfo\"><div class=\"nickname\"><span id=\"nick"+id+"\">"+nicks+"</span></div></div><div class=\"statistics\"><div class=\"stats1\"><span id=\"stats1"+id+"\"></span></div><div class=\"stats2\"><span id=\"stats2"+id+"\"></span></div><div class=\"stats3\"><span id=\"stats3"+id+"\"></span></div></div></div></section>";
    }
}
function makeStat(stats, s) {
    var stats = stats;
    stats = stats.split(":");
    function plainText(i) {
        switch (i) {
            case 0:
                return "Rozegrane gry: ";
            break;
            case 1:
                return "Wygrane gry: ";
            break;
            case 2:
                return "Największy majątek: ";
            break;
            case 3:
                return "Najwięcej w portfelu: ";
            break;
            case 4:
                return "Przegrane: ";
            break;
            case 5:
                return "Wygrane/przegrane: ";
            break;
        }
    }
    for (var i = 0; i<stats.length;i++) {
        var whileV = stats[i].split(";");
        if (whileV[0][0] == "1") {
            document.getElementById("stats"+whileV[0][2]+""+s).innerHTML = plainText(i) + whileV[1]; 
        }
    }
}
function loadGameInfo() {
    var xmlrequest = new XMLHttpRequest();
    xmlrequest.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var res = new Date().getTime()-pingS;
            console.log("ping: "+res);
            var data = this.responseText.split(";");
            if (data[3] != lastData[3]) {
                lastData=data;
                loadGamers(lastData[3]);
            }
            doDataThing(data);	
        }
    }
    xmlrequest.open("GET", "scripts/gameInfoLoad.php", true);
    xmlrequest.send();
    var pingS = new Date().getTime();
}


var interval = setInterval(loadGameInfo, 700);
function doDataThing(data) {
    var statusP = document.getElementById("status");
    var host = lastData[3].split(":");
    console.log(data +" "+ lastData);

    if (data[2] == lastData[4] && host[0] == di) {
        console.log(data +" "+ lastData);
        document.getElementById("startButt").innerHTML = "<button onclick=\"gameStarto()\">Rozpocznij grę!</button>";
    } else {
        document.getElementById("startButt").innerHTML = "";
    }
    if (data[1] != "0") {
        var href = window.location.href.slice(0, -9);
        window.location.href = href+"gameBoard/index.php";
    }
    if (data[2] < maxplayer) {
        statusP.innerHTML = "Oczekiwanie na graczy ("+data[2]+"/"+maxplayer+").";
    } else {
        statusP.innerHTML = "Oczekiwanie na rozpoczęcie przez niebieskiego!";
    }
}
function gameStarto() {
    var xmlrequest = new XMLHttpRequest();
    xmlrequest.open("GET", "scripts/gameStarto.php", true);
    xmlrequest.send();
}
function makeMoney(money) {
    switch (money) {
        case 1000000:
            return "1mln";
        break;
        case 2000000:
            return "2mln";
        break;
        case 3000000:
            return "3mln";
        break;
    }
}
function makeColors(data) {
data = data.split(":");
    for (var i = 0; i <=3; i++) {
        if (data[i] == 0) {
            continue;
        }
        var mystyle;
        switch (i) {
            case 0:
                mystyle = "blue";
            break;
            case 1:
                mystyle = "orange";
            break;
            case 2:
                mystyle = "purple";
            break;
            case 3:
                mystyle = "green";
            break;
        }
        document.getElementById("nick"+data[i]).classList.add(mystyle);
    }
}
loadGameInfo();
makeStat(window.IDZ, window.di);
document.getElementById("social").innerHTML = makeMoney(moneyC);
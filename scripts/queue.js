function doAll() {
    var placeInData;
    var data;
    var ping = Date.now();
    var xmlrequest = new XMLHttpRequest();
    xmlrequest.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("otherPlayers").innerHTML = "";
            document.getElementById("meHolder").innerHTML = "";

            //[0] gamestatus [1]activePlayer, [2]maxPlayers, [3]baseMoney
            //[4] time [5]players, [6]bool img, [7]nicks, [8]stats [9]bool me 
            //[10] time for tour

            data = this.responseText.split(";;");
            if (data == null || data == "Fatal_ERROR" || data == "ERROR") { 
                //alert("error");
                //console.log("error");
            } else {
                data[5] = data[5].split(":");
                data[6] = data[6].split(":");
                data[7] = data[7].split(":");
                data[8] = data[8].split("::");
                data[9] = data[9].split(":");
                //console.log(data);
                for (var i = 0; i < 4; i++) {
                    if (data[5][i] == "0") {
                        continue;
                    }
                    if (data[9][i] != "true") {
                        goWithBlock(i, "otherPlayers");
                    } else {
                        placeInData = i;
                        goWithBlock(i, "meHolder");
                    }
                }
                dealRestData();
            }
            console.log("Ping: "+(Date.now()-ping));
        }
    }
    xmlrequest.open("GET", "scripts/queueData.php", true);
    xmlrequest.send();

    function goWithBlock(i , where) {
        //console.log(i);
        var img = (data[6][i] == "true") ? data[5][i]+".jpg": "def.jpg";
        document.getElementById(where).innerHTML += `
        <section>
            <span class="profileIMG"><img src="avatars/${img}"></span>
            <div class="statisticsContainer">
                <div class="profileInfo">
                    <div class="nickname">
                        <span class="${makeColors(i)}">${data[7][i]}</span>
                    </div>
                </div>
                <div class="statistics">
                    <div class="stats1">
                        <span>${makeStat(data[8][i], "1")}</span>
                    </div>
                    <div class="stats2">
                        <span>${makeStat(data[8][i], "2")}</span>
                    </div>
                    <div class="stats3">
                        <span>${makeStat(data[8][i], "3")}</span>
                    </div>
                </div>
            </div>
        </section>`;
    }

    function makeColors(i) {
        switch (i) {
            case 0:
                return "blue";
            break;
            case 1:
                return "orange";
            break;
            case 2:
                return "purple";
            break;
            case 3:
                return "green";
            break;
        }
    }
    function makeStat(stats, s) {
        stats = stats.split(":");
        function statisticGetText(i) {
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
        for (var i = 0; i < stats.length; i++) {
            var whileV = stats[i].split(";");
            if (whileV[0][0] == "1" && whileV[0][2] == s) {
                
                return statisticGetText(i)+" "+whileV[1]; 
            }
        }
    }
    function dealRestData() {
        var statusPlace = document.querySelector("#gameStatus");  
        console.log(data[5][placeInData]);
        console.log(data[5]);
        console.log(placeInData);

        console.log(window.idMy);

        if (data[1] == data[2] && parseInt(data[5][0]) == window.idMy) {
            document.getElementById("startButt").innerHTML = "<button onclick=\"gameStarto()\">Rozpocznij grę!</button>";
        } else {
            document.getElementById("startButt").innerHTML = "";
        }
        console.log(data[1]);
        if (data[0] != "0") {
            var href = window.location.href.slice(0, -9);
            window.location.href = href+"../gameBoard/index.php";
        }
        if (data[1] < data[2]) {
            statusPlace.innerHTML = "Oczekiwanie na graczy ("+data[1]+"/"+data[2]+").";
        } else {
            statusPlace.innerHTML = "Oczekiwanie na rozpoczęcie przez niebieskiego!";
        }
        document.querySelector("#gameTime").innerHTML = data[4];
        document.querySelector("#gameTimeForTour").innerHTML = data[10];
        document.querySelector("#gameStartMoney").innerHTML = makeMoney(data[3]);

    }
    function makeMoney(money) {
        switch (parseInt(money)) {
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
}

function gameStarto() {
    var xmlrequest = new XMLHttpRequest();
    xmlrequest.open("GET", "scripts/gameStarto.php", true);
    xmlrequest.send();
}

doAll();
var interval = setInterval(doAll, 700);
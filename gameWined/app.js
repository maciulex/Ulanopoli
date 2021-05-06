function doAll() {
    var placeInData;
    var data;
    var ping = Date.now();
    var xmlrequest = new XMLHttpRequest();
    xmlrequest.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("otherPlayers").innerHTML = "";

            //[0] gamestatus [1]activePlayer, [2]maxPlayers, [3]baseMoney
            //[4] time [5]players, [6]bool img, [7]nicks, [8]stats [9]bool me 
            //[10] time for tour

            data = this.responseText.split(";;");
            console.log(data);
            if (data == null || data == "Fatal_ERROR" || data == "ERROR") { 
                //alert("error");
                console.log("error");
            } else {
                data[5] = data[5].split(":");
                data[6] = data[6].split(":");
                data[7] = data[7].split(":");
                data[8] = data[8].split("::");
                data[9] = data[9].split(":");

                data[12] = data[12].split(":");
                data[13] = data[13].split(":");
                data[14] = data[14].split(":");
                data[15] = data[15].split(":");
                data[16] = data[16].split(":");
                data[18] = data[18].split(":");


                console.log(data);

                //console.log(data);
                for (var i = 0; i < 4; i++) {
                    if (data[5][i] == "0") {
                        continue;
                    }
                    goWithBlock(i, "otherPlayers");
                }
                dealRestData();
            }
            console.log("Ping: "+(Date.now()-ping));
        }
    }
    xmlrequest.open("GET", "winedGameData.php?server="+window.serverId, true);
    xmlrequest.send();

    function goWithBlock(i , where) {
        //console.log(i);
        var img = (data[6][i] == "true") ? data[5][i]+".jpg": "def.jpg";
        document.getElementById(where).innerHTML += `
        <section>
            <span class="profileIMG"><img src="../avatars/${img}"></span>
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
        document.getElementById("Gracz"+(i+1)).innerHTML += `
            <span>Gracz ${data[7][i]}</span><br>
            <span>Pieniądze ${data[12][i]}</span><br>
            <span>Majątek ${data[14][i]}</span><br>
            <span>Wysp ${data[13][i]}</span><br>
            <span>${bancruitBlock(data[15][i])}</span><br>
            <span>Okrążeń planszy ${data[16][i]}</span><br><br>
        
        
        `;
    }
    function bancruitBlock(arg) {
        switch (arg) {
            case "0":
                return "Nie zbankrutował";
            break;
            case "1":
                return "Zbankrutował";
            break;
        }
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
        document.querySelector("#gameTime").innerHTML = data[4];
        document.querySelector("#gameTimeForTour").innerHTML = data[10];
        document.querySelector("#gameStartMoney").innerHTML = makeMoney(data[3]);
        document.querySelector("#gameRounds").innerHTML = data[17];
        document.querySelector("#gameName").innerHTML = data[11];
        document.querySelector("#gamePlayers").innerHTML = data[1];
        document.querySelector("#gameWinner").innerHTML = `Wygrał gracz: ${data[7][data[18][0]]}<br> Sposób: ${data[18][1]}`;

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

doAll();
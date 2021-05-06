//variables holding classes of game and players
var Cgame;
var Cplayers = [];
var idPositons = [];
var fildsDataGame = [];
var myTour;
var intervals;
var meIntVal;
var sellData = [false, 0, []];
var chempionData = [false, 0];
var travelData = [false, 0];
class Game {
    constructor (gameStatus, serverName, activePlayer, baseMoney, maxPlayer, time, timeForTour, tour, players, startTime, whosTour, fildsNfo, timeLeft = 3600,chempionFild) {
        this.gameStatus =   gameStatus;
        this.serverName =   serverName;
        this.activePlayer = activePlayer;
        this.baseMoney =    baseMoney;
        this.maxPlayer =    maxPlayer;
        this.time =         time;
        this.timeForTour =  timeForTour;
        this.tour =         tour;
        this.players =      players;
        this.startTime =    startTime;
        this.whosTour =     whosTour;
        this.fildsNfo =     fildsNfo;
        this.timeLeft =     timeLeft;
        this.chempionFild = chempionFild;
    }
}

class Player {
    constructor (id,name,money,place,cards,me,islands,wealth,moveCode,rounds) {
        this.id =      id;
        this.name =    name;
        this.money =   money;
        this.place =   place;
        this.cards =   cards;
        this.me =      me;
        this.islands = islands;
        this.wealth =  wealth;
        this.moveCode = moveCode;
        this.rounds = moveCode;
    }
}

function getAllGameData() {
    return new Promise (function (resolve) { 
        var xml = new XMLHttpRequest;
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != "Error") {
                    resolve(this.responseText);
                } else {
                    resolve("Error");
                }
            } else if (this.readyState == 4) {
                resolve("Error");
            }
        }
        xml.open("GET", "scripts/getGameData.php", true);
        xml.send();
    });
}

function getChangingGameData() {
    return new Promise (function (resolve) { 
        var xml = new XMLHttpRequest;
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != "Error") {
                    //console.log("here we go");
                    resolve(this.responseText.split(";;"));
                } else {
                    resolve("Error");
                }
            } else if (this.readyState == 4) {
                resolve("Error");
            }
        }
        xml.open("GET", "scripts/getGameChangingData.php", true);
        xml.send();
    });
}

function getLogs() {
    var xml = new XMLHttpRequest;
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            document.querySelector("#logPlace").innerHTML = this.responseText;
        }
    }
    xml.open("GET", "scripts/getLogs.php", true);
    xml.send();
}

function bancruit() {
    var xml = new XMLHttpRequest;
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
        }
    }
    xml.open('POST', "scripts/tourScripts/bancruit.php", true);
    xml.send();
}

async function refleshCheck() {
    var baseData = await getChangingGameData();
    //console.log(baseData);
    Cgame.gameStatus = parseInt(baseData[0]);
    Cgame.tour  =      baseData[2].split(";");
    Cgame.whosTour =   baseData[5].split(";");
    Cgame.fildsNfo =   baseData[6].split(";");
    Cgame.chempionFild=parseInt(baseData[14]);
    var place   = baseData[7].split(":");
    var money   = baseData[8].split(":");
    var cards   = baseData[9].split(":");
    var moveCode= baseData[11].split(":");
    var islands = baseData[12].split(":");
    var wealth  = baseData[13].split(":");
    var rounds  = baseData[15].split(":");
    for (var i = 0; i < Cgame.maxPlayer; i++) {
        Cplayers[i].place   = parseInt(place[i]);
        Cplayers[i].money   = parseInt(money[i]);
        Cplayers[i].wealth  = parseInt(wealth[i]);
        Cplayers[i].cards   = cards[i];
        Cplayers[i].islands = parseInt(islands[i]);
        Cplayers[i].moveCode= parseInt(moveCode[i]);
        Cplayers[i].rounds= parseInt(rounds[i]);
    }
    //console.log(baseData);
    if (Cgame.gameStatus == 2) {
        window.location.href = "../gameWined/index.php?server="+window.serverId;
    }
    if (Cplayers[baseData[5]].me == true) {
        //console.log("It's me mario 1");
        if (myTour != true) {
            console.log("It's me mario 2");
            myTour = true;    
            myTourEngine();
        }
    }
    drawFilds();
    getLogs();
    return;
}
function fildsDealer(level) {
    var xml = new XMLHttpRequest;
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            endTour();

        }
    }
    xml.open("GET", "scripts/tourScripts/buyFild.php?l="+level, true);
    xml.send();
    function endTour() {
        document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
        return;
    }
}

function wordChampions(arg,addic=0) {
    var xml = new XMLHttpRequest;
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText == "true") {
                chempionData[0] = true;
                let state = (chempionData[1] == 0) ? "disabled" : "" ;
                cityClicked("N2");
                deleteCityFromSold();
                document.querySelector("#buyFild").innerHTML = `<button onclick="wordChampions(2, ${chempionData[1]})" ${state}>Zakończ</button>`;
                if (chempionData[0] == true) {
                    document.querySelector("#sellOrFildInfo").innerHTML += `<span>Wybierz pole do mistrzostw świata</span>`;
                } else {
                    document.querySelector("#sellOrFildInfo").innerHTML += `<span>Wybierz pole do którego chcesz polecieć</span>`;
                }
            } else if (this.responseText == "Trued") {
                chempionData[0] = false;
                chempionData[1] = 0;
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ turę</button>';
                document.querySelector("#sellOrFildInfo").innerHTML = "";
            } else {
                alert("Somekinda uginda ERROR");
            }
        }
    }
    xml.open("GET", "scripts/tourScripts/buyFild.php?l="+arg+"&id="+addic, true);
    xml.send();
}
function travelF(arg,addic=0) {
    var xml = new XMLHttpRequest;
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText == "true") {
                travelData[0] = true;
                let state = (travelData[1] == 0) ? "disabled" : "" ;
                cityClicked("N2");
                deleteCityFromSold();
                document.querySelector("#buyFild").innerHTML = `<button onclick="travelF(2, ${travelData[1]})" ${state}>Zakończ</button>`;
                document.querySelector("#sellOrFildInfo").innerHTML += `<span>Wybierz pole do mistrzostw świata</span>`;
                document.querySelector("#sellOrFildInfo").innerHTML += `<span>Wybierz pole do którego chcesz polecieć</span>`;
            } else if (this.responseText == "Trued") {
                travelData[0] = false;
                travelData[1] = 0;
                document.querySelector("#sellOrFildInfo").innerHTML = "";
                myTourEngine();
            } else {
                alert("Somekinda uginda ERROR");
            }
        }
    }
    xml.open("GET", "scripts/tourScripts/buyFild.php?l="+arg+"&id="+addic, true);
    xml.send();
}

function endTourG() {
    var xml = new XMLHttpRequest;
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            document.querySelector("#throwResult").innerHTML = "";
            document.querySelector("#buyFild").innerHTML = "";
            myTour = false;
        }
    }
    xml.open("GET", "scripts/tourScripts/endTour.php", true);
    xml.send();

}

async function myTourEngine() {
    var data;
    async function xmlCreator(what) {
        return new Promise (function (resolve) {
            var xml = new XMLHttpRequest;
            xml.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText != "Error") {    
                        console.log(this.responseText);
                        resolve(this.responseText);
                    } else {
                        alert("Error");
                        resolve("Error");
                    }
                }
            }
            xml.open("GET", "scripts/tourScripts/"+what, true);
            xml.send();
        });
    }
    async function tourDealer() {
        data = await xmlCreator("tourValidityCheck.php");
        data.split("::");
        if (data == "Fatal_Error") {
            alert("Duży problem proszę się wylogować i zalogować.");
            return;
        } else if (data == "Connection_Error") {
            alert("Duży problem proszę skontaktować się z administratorem.");
            return;
        }
        if (data != "false") {
            data = data.split(";");
            console.log(data);
            switch (data[1]) {
                case "5":
                    travelData[0] = true;
                    var state = (travelData[1] == 0) ? "disabled" : "";
                    cityClicked("N2");
                    deleteCityFromSold();
                    document.querySelector("#buyFild").innerHTML = `<button onclick="travelF(2, ${chempionData[1]})" ${state}>Zakończ</button>`;
                    document.querySelector("#sellOrFildInfo").innerHTML += `<span>Wybierz pole do którego chcesz polecieć</span>`;
                break;
                case "4":
                    chempionData[0] = true;
                    var state = (chempionData[1] == 0) ? "disabled" : "";
                    cityClicked("N2");
                    deleteCityFromSold();
                    document.querySelector("#buyFild").innerHTML = `<button onclick="wordChampions(2, ${chempionData[1]})" ${state}>Zakończ</button>`;
                    document.querySelector("#sellOrFildInfo").innerHTML += `<span>Wybierz pole do mistrzostw świata</span>`;
                    console.log("I'm here");
                break;
                case "3":
                    sellData[0] = true;
                    //await sellFild();
                    cityClicked("N2");
                break;
                case "0":
                    console.log("dupa Wielka");
                    if (Cplayers[meIntVal].moveCode != 0) {
                        console.log("dupa");
                        buyFilds();
                    } else if (await throwCube() != "true") {
                        console.log("dupa1");
                        await buyFilds();    
                    } else {
                        console.log("dupa2");
                        sellData[0] = true;
                        //await sellFild();
                        cityClicked("N2");
                    }
                break;
                case "1":
                    buyFilds();
                break;  
                case "2":
                    document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
                break;
            }
        }
    } 
    async function throwCube() {
        //alert("Rzut kostką!");
        var result = await xmlCreator("makeMove.php");
        result = result.split(":");
        document.querySelector("#throwResult").innerHTML = "Kostka 1: "+result[0]+" Kostka 2: "+result[1];
        console.log(result[2]);
        await refleshCheck();
        return result[2];
    }
    async function buyFilds() {
        await refleshCheck();
        var place;
        for (var i = 0; i < Cgame.maxPlayer; i++) {
            if (Cplayers[i].me == true) {
                place = Cplayers[i].place;
                //console.log(i+" "+Cplayers[i].place);
                break;
            }
        }
        var state;
        switch(place) {
            case 0:
                //start
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
                console.log("pupa");               
            break;
            case 8:
                //bezludna wyspa
                var buttonState =  (Cplayers[meIntVal].cards.indexOf("a") == -1) ? "disabled" : "";
                document.querySelector("#buyFild").innerHTML += `<button onclick="fildsDealer(1)">Zapłać 200k</button>`;
                document.querySelector("#buyFild").innerHTML += `<button onclick="fildsDealer(2)" ${buttonState}>Użyj karty</button>`;
                document.querySelector("#buyFild").innerHTML += '<button onclick="endTourG()">Czekaj</button>';
            break;
            case 4:
            case 14:
            case 18:
            case 25:
                //wyspy
                var fild = Cgame.fildsNfo[place].split(":");
                switch (Cplayers[meIntVal].islands) {
                    case 0:
                        var price = 25000;
                    break;
                    case 1:
                        var price = 50000;
                    break;
                    case 2:
                        var price = 100000;
                    break;
                    case 3:
                        var price = 200000;
                    break;
                }
                if (fild[0] !== "0") {
                    document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
                } else {
                    document.querySelector("#buyFild").innerHTML = `<button onclick="fildsDealer(1)">Kup wyspę za: ${price}</button>`;
                    document.querySelector("#buyFild").innerHTML += '<button onclick="endTourG()">Zakończ</button>';
                }
            break;
            case 12:
            case 20:
            case 28:
                //szansa
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
            break;
            case 16:
                //Mistrzostwa świata
                state = (Cplayers[meIntVal].money < 50000) ? "disabled" : "";
                document.querySelector("#buyFild").innerHTML = `<button onclick="wordChampions(1)" ${state}>Kup mistrzostwa świata za: 50k</button>`;
                document.querySelector("#buyFild").innerHTML += `<button onclick="endTourG()">Zakończ</button>`;
            break;
            case 24:
                //Podróż
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
                state = (Cplayers[meIntVal].money < 50000) ? "disabled" : "";
                document.querySelector("#buyFild").innerHTML = `<button onclick="travelF(1)" ${state}>Kup podróż za: 50k</button>`;
                document.querySelector("#buyFild").innerHTML += `<button onclick="endTourG()">Zakończ</button>`;
            break;
            case 30:
                //Podatek
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
            break;
            default:
                var fild = Cgame.fildsNfo[place].split(":");
                var price = [];
                var disable = ["","","","",""];
                //kupienie pustego
                if (fild[0] == 0) {
                    for (var i = 0; i < 5; i++) {
                        console.log(fildsDataGame[place][i]);
                        if (Cplayers[meIntVal].money > fildsDataGame[place][i] && i != 4) {
                            price.push(fildsDataGame[place][i]);
                        } else {
                            price.push(fildsDataGame[place][i]);
                            disable[i] = "disabled";  
                        }
                    }
                //ulepszenie
                } else if (Cplayers[(fild[0]-1)].me == true) {
                    for (var i = 0; i < 5; i++) {
                        if (fild[1] >= i || (fild[1] != 3 && i == 4)) {
                            price.push(fildsDataGame[place][i]);
                            disable[i] = "disabled";
                        } else {
                            if (Cplayers[meIntVal].money > fildsDataGame[place][i]) {
                                price.push(fildsDataGame[place][i]);
                            } else {
                                price.push(fildsDataGame[place][i]);
                                disable[i] = "disabled";  
                            }
                        }
                    }
                } else {
                    for (var i = 0; i < 5; i++) {
                        if (fild[1] > i || fild[1] == 4 || (fild[1] != 3 && i == 4)) {
                            price.push(fildsDataGame[place][i]*2);
                            disable[i] = "disabled";
                        } else {
                            if (Cplayers[meIntVal].money > fildsDataGame[place][i]*2) {
                                price.push(fildsDataGame[place][i]*2);
                            } else {
                                price.push(fildsDataGame[place][i]*2);
                                disable[i] = "disabled";  
                            }
                        }
                    }
                }
                fild[1] = parseInt(fild[1]);
                if (fild[1] != 0 && fild[1] < 5 && fild[0] != 0) {
                    if (Cplayers[(fild[0]-1)].me == true) {
                        for (var i = fild[1]+1; i < 5; i++) {
                            price[i] -= price[fild[1]];
                        }
                    }
                }
                var raw = `
                    <button ${disable[0]} onclick="fildsDealer(1)">Lvl: 1 - ${price[0]}</button>
                    <button ${disable[1]} onclick="fildsDealer(2)">Lvl: 2 - ${price[1]}</button>
                    <button ${disable[2]} onclick="fildsDealer(3)">Lvl: 3 - ${price[2]}</button>
                    <button ${disable[3]} onclick="fildsDealer(4)">Lvl: 4 - ${price[3]}</button>
                    <button ${disable[4]} onclick="fildsDealer(5)">Lvl: 5 - ${price[4]}</button>
                    '<button onclick="endTourG()">Zakończ</button>'
                `;
                document.querySelector("#buyFild").innerHTML = raw;
            break;
        }
    }
    tourDealer();
    return;
}

function getFildsData() {
    return new Promise(function (resolve) {
        var xml = new XMLHttpRequest;
        xml.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {
                //console.log(this.responseText);
                getFildsToVar(this.responseText);
            }
        }
        xml.open("GET", "scripts/getFildsFromFilds.php", true);
        xml.send();
        function getFildsToVar(data) {
            data = data.split(";");
            for (var i = 0; i < data.length-1; i++) {
                var id =  data[i].split("::");
                var lvls = id[1].split(":");
                id = id[0]; 
                fildsDataGame.push([[parseInt(lvls[0])],[parseInt(lvls[1])],[parseInt(lvls[2])],[parseInt(lvls[3])],[parseInt(lvls[4])],[lvls[5]]]);
            }
            resolve("Done");
        }
    });
}

function cityClicked(cityId) {
    var place = document.querySelector("#sellOrFildInfo");
    place.innerHTML = "";
    cityId = cityId.slice(1);

    console.log(cityId);
    if (chempionData[0] == true) {
        let fild = Cgame.fildsNfo[cityId].split(":");
        if (fild[0] == meIntVal+1) {
            chempionData[1] = cityId;
            place.innerHTML = "<span onclick=\"deleteCityFromSold()\">Chcesz mieć mistrzostwa na polu: "+fildsDataGame[cityId][5]+"</span>";
        } else {
            place.innerHTML = "<span>Mistrzostwa możesz mieć tylko na swoim polu!</span>";
            if (chempionData[1] != 0) {
                place.innerHTML += "<span><br>Mistrzostwa obecnie organizujesz na: "+fildsDataGame[chempionData[1]][5]+"!</span>";
            }
        }
        let state = (chempionData[1] == 0) ? "disabled": "";
        document.querySelector("#buyFild").innerHTML = `<button onclick="wordChampions(2, ${chempionData[1]})" ${state}>Zakończ</button>`;
        return;
    } else if (travelData[0] == true) {
        let fild = Cgame.fildsNfo[cityId].split(":");
        if (fild[0] == meIntVal+1 || fild[0] == 0) {
            travelData[1] = cityId;
            place.innerHTML = "<span onclick=\"deleteCityFromSold()\">Chcesz polecieć na pole: "+fildsDataGame[cityId][5]+"</span>";
        } else {
            place.innerHTML = "<span>Podróż możesz mieć tylko na swoim polu/lub na puste!</span>";
            if (travelData[1] != 0) {
                place.innerHTML += "<span><br>Jedziesz obecnie na: "+fildsDataGame[travelData[1]][5]+"!</span>";
            }
        }
        let state = (travelData[1] == 0) ? "disabled": "";
        document.querySelector("#buyFild").innerHTML = `<button onclick="travelF(2, ${travelData[1]})" ${state}>Zakończ</button>`;
        return;
    }
    if (sellData[0] == false) {
        if (cityId == -1) {
            place = "";
            return;
        }
        place.innerHTML += "Pole o nazwie: "+document.querySelector("#N"+cityId).textContent+"<br>";
        for (var i = 0; i < 5; i++) {
            place.innerHTML += "Koszt budynku na poziomie "+(i+1)+": "+fildsDataGame[cityId][i]+"<br>";
        }
        place.innerHTML += '<button onclick="cityClicked(-1)">Zamknij</button><br>';
    } else {
        var fildData = Cgame.fildsNfo[cityId].split(":");    
        fildData[0] = parseInt(fildData[0]);
        if (fildData[0]-1 == meIntVal) {
            let state = true;
            for (var i = 0; i < sellData[2].length; i++) {
                if (sellData[2][i][0] == cityId) {
                    state = false;
                    break;
                }
            }
            if (state) {
                var fildName = document.querySelector("#N"+cityId).textContent;
                var fildCost = fildsDataGame[cityId][fildData[1]];
                sellData[1] += parseInt(fildCost);
                sellData[2].unshift([parseInt(cityId),fildName,fildCost]);
            }
        }
        place.innerHTML += "Wartość pól: "+sellData[1]+"<br>";
        place.innerHTML += "Sprzedajesz pola: <br>";
        for (var i = 0; i < sellData[2].length; i++) {
            place.innerHTML += `<div onclick="deleteCityFromSold(${i})">${sellData[2][i][1]}, Wartość: ${sellData[2][i][2]}</div>`;
        }
        let state = (Cplayers[meIntVal].money*(-1) < sellData[1]) ? "" : "disabled" ;
        document.querySelector("#buyFild").innerHTML = `<button onclick="sellFild()" ${state}>Sprzedaj i zakończ</button>`;
        document.querySelector("#buyFild").innerHTML += `<button onclick="bancruit()" >Zbankrutuj</button>`;
    }
    return;
}
function deleteCityFromSold(i) {
    var place = document.querySelector("#sellOrFildInfo");
    if (chempionData[0] == true) {
        chempionData[1] = 0;
        place.innerHTML = "";
        return;
    } else if (travelData[0] == true) {
        travelData[1] = 0;
        place.innerHTML = "";
        return;
    }
    place.innerHTML = "";
    sellData[1]-=sellData[2][i][2];
    sellData[2].splice(i,1);
    place.innerHTML += "Wartość pól: "+sellData[1]+"<br>";
    place.innerHTML += "Sprzedajesz pola: <br>";
    for (var z = 0; z < sellData[2].length; z++) {
        place.innerHTML += `<div onclick="deleteCityFromSold(${z})">${sellData[2][z][1]}, Wartość: ${sellData[2][z][2]}</div>`;
    }
    let state = (Cplayers[meIntVal].money*(-1) < sellData[1]) ? "" : "disabled" ;
    document.querySelector("#buyFild").innerHTML = `<button onclick="sellFild()" ${state}>Sprzedaj i zakończ</button>`;
    document.querySelector("#buyFild").innerHTML += `<button onclick="bancruit()" >Zbankrutuj</button>`;
    return;
}

async function sellFild() {
    console.log("Hur dur");
    var data = sellData[2][0][0];
    for (var i = 1; i < sellData[2].length;i++) {
        data += ":"+sellData[2][i][0];
    }
    var xml = new XMLHttpRequest;
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText == "LIFU") {
                document.querySelector("#sellOrFildInfo").innerHTML = "";
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
                sellData[0] = false;
                sellData[1] = 0;
                sellData[2] = [];
            } else {
                alert("przeładuj strone ERROR");
            }
        }
    }
    xml.open("POST", "scripts/tourScripts/sellThisFilds.php", true);
    xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xml.send("data="+data);
}

function drawFilds() {
    var fildsData = Cgame.fildsNfo;
    for (var i = 0; i <= 31; i++) {
        var localData = fildsData[i].split(":");
        switch(i) {
            case 0:
            case 8:
            case 12:
            case 16:
            case 20:
            case 24:
            case 28:
            case 30:
            break;
            default:
                if (localData[0] != 0) {
                    //console.log("KAME HAME");
                    if (document.getElementsByClassName("Player"+localData[0]).length > 0) {
                        document.querySelector(".Player"+localData[0]).classList.remove("Player"+(localData[0]-1));
                    }
                   document.querySelector("#N"+i).classList.add("Player"+(localData[0]-1));
                   document.querySelector("#L"+i).innerHTML = parseInt(localData[1])+1;
                   document.querySelector("#C"+i).innerHTML = fildsDataGame[i][parseInt(localData[1])]/2;
                } else {
                    document.querySelector("#N"+i).removeAttribute('class');
                    document.querySelector("#C"+i).innerHTML = 0;
                }
            break;
        }
    }
    for (var i = 0; i < Cgame.maxPlayer; i++) {
        document.querySelector("#PlayerB"+i).remove();
        document.querySelector("#playerInCity"+Cplayers[i].place).innerHTML += `<span id="PlayerB${i}">P</span>`;
        document.querySelector("#player"+(i+1)+" .moneyNumber").innerHTML = Cplayers[i].money;
    }
    //console.log(Cgame.chempionFild);
    if (!isNaN(Cgame.chempionFild) && Cgame.chempionFild != "") {
        //console.log(Cgame.fildsNfo[Cgame.chempionFild]);
        var fild = Cgame.fildsNfo[Cgame.chempionFild].split(":");
        var price = (fildsDataGame[Cgame.chempionFild][fild[1]]/2)*parseFloat(fild[2]);
        document.querySelector("#C"+Cgame.chempionFild).innerHTML = price;
    }
    return;
}

async function onLoad() {
    document.querySelector("#idk").innerHTML = "";
    var allGameData = await getAllGameData();
    if (allGameData == "Error") {
        alert("ERROR");
        return;
    }
    var timeLeft = 0;
    allGameData =  allGameData.split(";;"); 
    var players =  allGameData[10].split(":");
    var fildsNfo = allGameData[13].split(";");
    var id =       allGameData[10].split(":");
    var place =    allGameData[14].split(":");
    console.log(allGameData);
    var money =    allGameData[15].split(":");
    var cards =    allGameData[16].split(":");
    var moveCode = allGameData[18].split(":");
    var islands =  allGameData[19].split(":");
    var wealth =   allGameData[20].split(":");
    var nicks =    allGameData[22].split(":");
    var rounds =    allGameData[23].split(":");
    Cgame = new Game (allGameData[1],allGameData[0],allGameData[2],allGameData[3],allGameData[4],allGameData[5],allGameData[6],allGameData[7],players,allGameData[11],allGameData[12],fildsNfo,timeLeft,parseInt(allGameData[allGameData.length-2]));
    for (var i = 0; i < allGameData[4]; i++) {
        var me = false;
        if (window.nick == nicks[i]) {
            me = true;
            meIntVal = i;
        }
        var placeholderClass = new Player (parseInt(id[i]),nicks[i],parseInt(money[i]),parseInt(place[i]),cards[i], me, parseInt(islands[i]), parseInt(wealth[i]),parseInt(moveCode[i]), parseInt(rounds[i]));
        Cplayers.push(placeholderClass);
        idPositons.push(id[i]);
    }

    //loading data to screen;
    allGameData[4] = parseInt(allGameData[4]);
    for (var i = 0; i < allGameData[4]; i++) {
        document.querySelector("#player"+(i+1)+" .playerName").innerHTML = Cplayers[i].name;
        document.querySelector("#player"+(i+1)+" .moneyNumber").innerHTML = Cplayers[i].money;
    }
    for (var i = allGameData[4]; i < 4; i++) {
        document.querySelector("#player"+(i+1)).innerHTML = "";
    }
    //console.log(allGameData);
    await getFildsData();
    drawFilds();
    for (var i = 0; i < document.querySelectorAll(".normalBlock").length; i++) {
        switch (i) {
            case 3:  
                continue;
            break;
        }
        document.querySelectorAll(".normalBlock")[i].setAttribute("onclick", "cityClicked(\""+(document.querySelectorAll(".normalBlock")[i].querySelector(".cityName div").id)+"\")");
    }
    for (var i = 0; i < document.querySelectorAll(".normalBlockM").length; i++) {
        switch (i) {
            case 6:  
            case 7:  
            case 11:  
                continue;
            break;
        }
        document.querySelectorAll(".normalBlockM")[i].setAttribute("onclick", "cityClicked(\""+document.querySelectorAll(".normalBlockM")[i].querySelector(".cityName div").id+"\")");
    }
    intervals = setInterval(refleshCheck, 500);
    return;
}

onLoad();

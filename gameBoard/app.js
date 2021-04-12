//variables holding classes of game and players
var Cgame;
var Cplayers = [];
var idPositons = [];
var fildsDataGame = [];
var myTour;
var intervals;

class Game {
    constructor (gameStatus, serverName, activePlayer, baseMoney, maxPlayer, time, timeForTour, tour, players, startTime, whosTour, fildsNfo, timeLeft = 3600) {
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
    }
}

class Player {
    constructor (id,name,money,place,cards,me,islands,wealth) {
        this.id =      id;
        this.name =    name;
        this.money =   money;
        this.place =   place;
        this.cards =   cards;
        this.me = me;
        this.islands = islands;
        this.wealth = wealth;

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

async function refleshCheck() {
    var baseData = await getChangingGameData();
    Cgame.fildsNfo = baseData[6].split(";");
    Cgame.whosTour = baseData[5].split(";");
    Cgame.tour = baseData[2].split(";");
    var place = baseData[7].split(":");
    var money = baseData[8].split(":");
    var cards = baseData[9].split(":");
    var islands = baseData[12].split(":");
    var wealth = baseData[13].split(":");
    for (var i = 0; i < Cgame.maxPlayer; i++) {
        Cplayers[i].place = parseInt(place[i]);
        Cplayers[i].money = parseInt(money[i]);
        Cplayers[i].cards = cards[i];
        Cplayers[i].islands = islands[i];
        Cplayers[i].wealth = parseInt(wealth[i]);
    }
    //console.log(baseData);
    if (Cplayers[baseData[5]].me == true) {
        if (myTour != true) {
            //console.log("It's me mario");
            myTour = true;    
            myTourEngine();
        }
    }
    drawFilds();
    return;
}
function fildsDealer() {
    async function buyFilds() {

        return;
    }
    async function specialFildsDealer() {

        return;
    }
    async function endTour() {

        return;
    }
}
function myTourEngine() {
    var data;
    function xmlCreator(what) {
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
                case "0":
                    throwCube();
                    buyFilds();    
                break;
                case "1":
                    buyFilds();
                break;  
            }
        }
    } 
    async function throwCube() {
        alert("Rzut kostką!");
        var result = await xmlCreator("makeMove.php");
        document.querySelector("#throwResult").innerHTML = result;
        return;
    }
    function buyFilds() {
        document.querySelector("#throwResult").innerHTML = data[2][0]+":"+data[2][1];
        place = document.querySelector("#buyFild");
        console.log(data);
        switch(i) {
            case 0:
                //start

            break;
            case 8:
                //bezludna wyspa

            break;
            case 4:
            case 14:
            case 18:
            case 25:
                //wyspy
                
            break;
            case 12:
            case 20:
            case 28:
                //szansa

            break;
            case 16:
                //Mistrzostwa świata

            break;
            case 24:
                //Podróż

            break;
            case 30:
                //Podatek

            break;
            default:

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
                fildsDataGame.push([[parseInt(lvls[0])],[parseInt(lvls[1])],[parseInt(lvls[2])],[parseInt(lvls[3])],[parseInt(lvls[4])]]);
            }
            resolve("Done");
        }
    });
}
async function onLoad() {
    document.querySelector("#idk").innerHTML = "";
    var allGameData = await getAllGameData();
    if (allGameData == "Error") {
        alert("ERROR");
        return;
    }
    var timeLeft = 0;
    allGameData = allGameData.split(";;"); 
    var players = allGameData[10].split(":");
    var fildsNfo = allGameData[13].split(";");
    var id =     allGameData[10].split(":");
    var place =  allGameData[14].split(":");
    var money =  allGameData[15].split(":");
    var cards =  allGameData[16].split(":");
    var islands =allGameData[19].split(":");
    var wealth = allGameData[20].split(":");
    var nicks =  allGameData[21].split(":");
    Cgame = new Game (allGameData[1],allGameData[0],allGameData[2],allGameData[3],allGameData[4],allGameData[5],allGameData[6],allGameData[7],players,allGameData[11],allGameData[12],fildsNfo,timeLeft);
    for (var i = 0; i < allGameData[4]; i++) {
        var me = false;
        if (window.nick == nicks[i]) {
            me = true;
        }
        var placeholderClass = new Player (parseInt(id[i]),nicks[i],parseInt(money[i]),parseInt(place[i]),cards[i], me, islands[i], parseInt(wealth[i]));
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
    intervals = setInterval(refleshCheck,500);
    return;
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
                        document.querySelector(".Player"+localData[0]).classList.remove("Player"+localData[0])
                    }
                   document.querySelector("#N"+i).classList.add("Player"+localData[0]);
                   document.querySelector("#L"+i).innerHTML = localData[1];
                   document.querySelector("#C"+i).innerHTML = fildsDataGame[i][parseInt(localData[1])]*parseFloat(localData[2]);
                }
            break;
        }
    }
    for (var i = 0; i < Cgame.maxPlayer; i++) {
        document.querySelector("#PlayerB"+i).remove();
        document.querySelector("#playerInCity"+Cplayers[i].place).innerHTML += `<span id="PlayerB${i}">P</span>`;
    }
    return;
}

onLoad();
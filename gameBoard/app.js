//variables holding classes of game and players
var Cgame;
var Cplayers = [];
var idPositons = [];
var fildsDataGame = [];
var myTour;
var intervals;
var meIntVal;

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
        this.me =      me;
        this.islands = islands;
        this.wealth =  wealth;

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
                    console.log("here we go");
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
    Cgame.tour  = baseData[2].split(";");
    var place   = baseData[7].split(":");
    var money   = baseData[8].split(":");
    var cards   = baseData[9].split(":");
    var islands = baseData[12].split(":");
    var wealth  = baseData[13].split(":");
    for (var i = 0; i < Cgame.maxPlayer; i++) {
        Cplayers[i].place   = parseInt(place[i]);
        Cplayers[i].money   = parseInt(money[i]);
        Cplayers[i].wealth  = parseInt(wealth[i]);
        Cplayers[i].cards   = cards[i];
        Cplayers[i].islands = islands[i];
    }
    console.log(baseData);
    if (Cplayers[baseData[5]].me == true) {
        console.log("It's me mario 1");
        if (myTour != true) {
            console.log("It's me mario 2");
            myTour = true;    
            myTourEngine();
        }
    }
    drawFilds();
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

function endTourG() {
    var xml = new XMLHttpRequest;
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            document.querySelector("#throwResult").innerHTML = "";
            document.querySelector("#buyFild").innerHTML = "";
            console.log(Cplayers[meIntVal].myTour);
            myTour = false;
            console.log(Cplayers[meIntVal].myTour);
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
                case "0":
                    await throwCube();
                    await buyFilds();    
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
        alert("Rzut kostką!");
        var result = await xmlCreator("makeMove.php");
        document.querySelector("#throwResult").innerHTML = result;
        await refleshCheck();
        return;
    }
    async function buyFilds() {
        var place;
        for (var i = 0; i < Cgame.maxPlayer; i++) {
            if (Cplayers[i].me == true) {
                place = Cplayers[i].place;
                console.log(i+" "+Cplayers[i].place);
                break;
            }
        }
        switch(place) {
            case 0:
                //start
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
                console.log("pupa");               
            break;
            case 8:
                //bezludna wyspa
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
            break;
            case 4:
            case 14:
            case 18:
            case 25:
                //wyspy
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
            break;
            case 12:
            case 20:
            case 28:
                //szansa
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
            break;
            case 16:
                //Mistrzostwa świata
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
            break;
            case 24:
                //Podróż
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
            break;
            case 30:
                //Podatek
                document.querySelector("#buyFild").innerHTML = '<button onclick="endTourG()">Zakończ</button>';
            break;
            default:
                var fild = Cgame.fildsNfo[place].split(":");
                var price = [];
                var disable = ["","","","",""];
                if (fild[0] == 0) {
                    for (var i = 0; i < 5; i++) {
                        console.log(fildsDataGame[place][i]);
                        if (Cplayers[meIntVal].money > fildsDataGame[place][i]) {
                            price.push(fildsDataGame[place][i]);
                        } else {
                            price.push(fildsDataGame[place][i]);
                            disable[i] = "disabled";  
                        }
                    }
                } else if (Cplayers[(fild[0]-1)].me == true) {
                    for (var i = 0; i < 5; i++) {
                        if (fild[1] >= i) {
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
                        if (fild[1] >= i) {
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
    allGameData =  allGameData.split(";;"); 
    var players =  allGameData[10].split(":");
    var fildsNfo = allGameData[13].split(";");
    var id =       allGameData[10].split(":");
    var place =    allGameData[14].split(":");
    var money =    allGameData[15].split(":");
    var cards =    allGameData[16].split(":");
    var islands =  allGameData[19].split(":");
    var wealth =   allGameData[20].split(":");
    var nicks =    allGameData[21].split(":");
    Cgame = new Game (allGameData[1],allGameData[0],allGameData[2],allGameData[3],allGameData[4],allGameData[5],allGameData[6],allGameData[7],players,allGameData[11],allGameData[12],fildsNfo,timeLeft);
    for (var i = 0; i < allGameData[4]; i++) {
        var me = false;
        if (window.nick == nicks[i]) {
            me = true;
            meIntVal = i;
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
                        document.querySelector(".Player"+localData[0]).classList.remove("Player"+(localData[0]-1));
                    }
                   document.querySelector("#N"+i).classList.add("Player"+(localData[0]-1));
                   document.querySelector("#L"+i).innerHTML = parseInt(localData[1])+1;
                   document.querySelector("#C"+i).innerHTML = (fildsDataGame[i][parseInt(localData[1])])*parseFloat(localData[2]);
                }
            break;
        }
    }
    for (var i = 0; i < Cgame.maxPlayer; i++) {
        document.querySelector("#PlayerB"+i).remove();
        document.querySelector("#playerInCity"+Cplayers[i].place).innerHTML += `<span id="PlayerB${i}">P</span>`;
        document.querySelector("#player"+(i+1)+" .moneyNumber").innerHTML = Cplayers[i].money;
    }
    return;
}

onLoad();

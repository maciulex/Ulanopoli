//variables holding classes of game and players
var Cgame;
var Cplayers = [];
var me;
var timer;
var intervals;

class Game {
    constructor (serverName, activePlayer, baseMoney, maxPlayer, time, timeForTour, tour, players, startTime, whosTour, fildsNfo, timeLeft = 3600) {
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
    constructor (id,name,money,place,idPlace,cards) {
        this.id =      id;
        this.name =    name;
        this.money =   money;
        this.place =   place;
        this.idPlace = idPlace;
        this.cards =   cards;
    }
    set updateMoney(money) {
        this.money = money;
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

async function onLoad() {
    document.querySelector("#idk").innerHTML = "";
    var allGameData = await getAllGameData();
    if (allGameData == "Error") {
        alert("ERROR");
        return;
    } 
    return;
}



onLoad();
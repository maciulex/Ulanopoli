
class Game {
    // updateAll (gameStatus, serverName, activePlayer, baseMoney, maxPlayer, time, timeForTour, tour, players, startTime, whosTour, fildsNfo, timeLeft = 3600,chempionFild) {
    //     this.gameStatus =   gameStatus;
    //     this.serverName =   serverName;
    //     this.activePlayer = activePlayer;
    //     this.baseMoney =    baseMoney;
    //     this.maxPlayer =    maxPlayer;
    //     this.time =         time;
    //     this.timeForTour =  timeForTour;
    //     this.tour =         tour;
    //     this.players =      players;
    //     this.startTime =    startTime;
    //     this.whosTour =     whosTour;
    //     this.fildsNfo =     fildsNfo;
    //     this.timeLeft =     timeLeft;
    //     this.chempionFild = chempionFild;
    // }
    xmlRequestEngine(action) {
        let xml = new XMLHttpRequest;
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        }
        xml.open("GET", "scripts/gameEngine.php?action="+action);
        xml.send();
    }
    updateGameData() {
        let data = this.xmlRequestEngine(1);
        
    }
    refreshmentAndValidation() {
        this.updateGameData();
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

var GAME = new Game();
GAME.updateGameData();

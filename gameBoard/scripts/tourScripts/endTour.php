<?php 
    session_start();
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    $logsValue = "";
    $movesCodes = "";

    if ($gameData[4][$gameData[1]] == $_SESSION['id']) {
        echo $gameData[0];
        if ($gameData[0] == 2 || $gameData[0] == 1 || (($gameData[0] == 6 || $gameData[0] == 0) && $gameData[6][$gameData[1]] == 8)) {
            if ($gameData[9][$gameData[1]] < 0) {
                $logsValue = "System wykrył że gracz jednak musi coś sprzedać!";
                $sql = 'UPDATE game SET, eventCode = 3, WHERE gameID = '.$_SESSION["gameId"];
                $sql2 = 'UPDATE game SET logs = CONCAT(\''.$logsValue.'\',logs) WHERE gameID = '.$_SESSION["gameId"];
                $connection -> multi_query($sql.";".$sql2);
                mysqli_close($connection);
                exit();
            }
            if ($gameData[0] == 0 && $gameData[6][$gameData[1]] == 8 || !isset($gameData[2][0])) {
                $gameData[2][0] = 1;
                $gameData[2][1] = 0;
            }
            $whoTour = $gameData[1];
            $tour = "";
            if ($gameData[2][0] == $gameData[2][1] || $gameData[0] == 6) {
                $whoTour = $gameData[1];
                $logsValue .="<span>Gracz kontynuuje turę</span>";
            } else {
                $players = $gameData[4];
                $playersNum = 0;
                for ($i = 0; $i < 4; $i++) {
                    if ($players[$i] != 0) {
                        $playersNum+=1;
                    } else {
                        break;
                    }
                }
                if ($whoTour == $playersNum-1) {
                    $result = $connection -> query("SELECT tour FROM game WHERE gameID = ".$_SESSION['gameId']);
                    $row = $result -> fetch_object();
                    $whoTour = 0;
                    $tour = ", tour=tour+1";
                    $logsValue .= "<hr class=\"L_tourHrEnd\">";
                    $logsValue .= "<span>Tura: ".(intval($row->tour)+1)."</span>";
                    $logsValue .= "<hr class=\"L_tourHrEnd\">";
                    $logsValue .= "<hr class=\"L_tourHrNext\">";
                    $logsValue .= "<span>Tura gracza: ".($gameData[15][$whoTour])."</span>";
                } else {
                    $whoTour = $gameData[1]+1;
                    $logsValue .= "<hr class=\"L_tourHrNext\">";
                    $logsValue .= "<span>Tura gracza: ".($gameData[15][$whoTour])."</span>";
                }
            }
            if ($gameData[6][$gameData[1]] == 8 && $gameData[3][$gameData[1]] != 0) {
                $gameData[3][$gameData[1]] -= 1;
                $movesCodes = ",movesCodes = \"".implode(":", $gameData[3])."\"";
            }
            print_r($gameData[13]);
            echo "53: game 13: ".$gameData[13][$whoTour]." ";
            if ($gameData[13][$whoTour] == 1) {
                $noMore = false;
                for ($i = $whoTour; $i <= $playersNum; $i++) {
                    echo "56: Who tour: ".$whoTour." Player num: ".$playersNum." "; 
                    if ($gameData[13][$i] == 1) {
                        echo "58: game data 13: ".$gameData[13][$i]." i: ". $i ." ";
                        $whoTour +=1;
                        echo "60: Who tour: ".$whoTour." ";
                    } else {
                        echo "62: break ";
                        echo "game data 13: ".$gameData[13][$i]." i: ". $i ." ";
                        echo "Who tour: ".$whoTour." ";
                        break;
                    }
                    if ($i == $playersNum && $noMore == false) {
                        echo "68: nomore ";
                        $whoTour = 0;
                        $i = 0;
                        $noMore = true;
                    }
                }
            }
            $sql = 'UPDATE game SET trowed = NULL, eventCode = 0, whosTour = '.$whoTour.$tour.$movesCodes.' WHERE gameID = '.$_SESSION["gameId"];
            echo $sql;
            $sql2 = 'UPDATE game SET logs = CONCAT(\''.$logsValue.'\',logs) WHERE gameID = '.$_SESSION["gameId"];
            $connection -> multi_query($sql.";".$sql2);
            header("Location: win.php");
            mysqli_close($connection);
            exit();
        } else {
            echo "Error2";
            exit();
        }
    } else {
        echo "Error1";
        exit();
    }
    
    
?>
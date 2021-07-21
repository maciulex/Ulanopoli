<?php
    session_start();
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    //wyspy
    $win = array(false, -1, "");
    for ($i = 0; $i < 4; $i++) {
        if ($gameData[10][$i] == 4) {
            $win[0] = true;
            $win[1] = $i;
            $win[2] = "Zdobył 4 wyspy";
        }
    }

    checkWin();
    $gooMono = array(0,0,0,0);


    $arr = array();
    $arr[] = ($gameData[5][1][0] == $gameData[5][2][0] && $gameData[5][2][0] == $gameData[5][3][0])     ? addFild($gameData[5][1][0])  : false;
    $arr[] = ($gameData[5][5][0] == $gameData[5][6][0] && $gameData[5][6][0] == $gameData[5][7][0])     ? addFild($gameData[5][5][0])  : false;
    $arr[] = ($gameData[5][9][0] == $gameData[5][10][0] && $gameData[5][10][0] == $gameData[5][11][0])  ? addFild($gameData[5][9][0])  : false;
    $arr[] = ($gameData[5][13][0] == $gameData[5][15][0])                                               ? addFild($gameData[5][13][0]) : false;
    $arr[] = ($gameData[5][17][0] == $gameData[5][19][0])                                               ? addFild($gameData[5][17][0]) : false;
    $arr[] = ($gameData[5][21][0] == $gameData[5][22][0] && $gameData[5][22][0] == $gameData[5][23][0]) ? addFild($gameData[5][21][0]) : false;
    $arr[] = ($gameData[5][26][0] == $gameData[5][27][0])                                               ? addFild($gameData[5][26][0]) : false;
    $arr[] = ($gameData[5][29][0] == $gameData[5][31][0])                                               ? addFild($gameData[5][29][0]) : false;
    //potrujny monopol
    print_r($gameData[5]);
    print_r($arr);
    function addFild($arg) {
        global $gooMono;
        if ($arg == "1") {
            $gooMono[0] += 1;
        } else if ($arg == "2") {
            $gooMono[1] += 1;
        } else if ($arg == "3") {
            $gooMono[2] += 1;
        } else if ($arg == "4") {
            $gooMono[3] += 1;
        }
        return $arg;
    }

    if ($gooMono[0] >= 3) {
        $win[0] = true;
        $win[1] = 0;
        $win[2] = "Z konstruował 3 monopole.";         
    } else if ($gooMono[1] >= 3) {
        $win[0] = true;
        $win[1] = 1;
        $win[2] = "Z konstruował 3 monopole.";
    } else if ($gooMono[2] >= 3) {
        $win[0] = true;
        $win[1] = 2;
        $win[2] = "Z konstruował 3 monopole.";
    } else if ($gooMono[3] >= 3) {
        $win[0] = true;
        $win[1] = 3;
        $win[2] = "Z konstruował 3 monopole.";
    }
    checkWin();

    //monopol liniowy
    if ($arr[0] != false && $arr[0] == $arr[1] && $arr[1] == $gameData[5][4][0]) {
        $win[0] = true;
        $win[1] = intval($arr[0])-1;
        $win[2] = "Z konstruował monopol liniowy";
    }
    if ($arr[2] != false && $arr[2] == $arr[3] && $arr[2] == $gameData[5][14][0]) {
        $win[0] = true;
        $win[1] = intval($arr[2])-1;
        $win[2] = "Z konstruował monopol liniowy";
    }
    if ($arr[4] != false && $arr[4] == $arr[5] && $arr[4] == $gameData[5][18][0]) {
        $win[0] = true;
        $win[1] = intval($arr[4])-1;
        $win[2] = "Z konstruował monopol liniowy";
    }
    if ($arr[6] != false && $arr[6] == $arr[7] && $arr[6] == $gameData[5][25][0]) {
        $win[0] = true;
        $win[1] = intval($arr[6])-1;
        $win[2] = "Z konstruował monopol liniowy";
    }

    checkWin();

    //eliminacja 
    $eliminationVar = -2;
    for ($i = 0; $i < 4; $i++) {
        if ($gameData[13][$i] != 1 && $gameData[4][$i] != 0) {
            if ($eliminationVar != -2) {
                $eliminationVar = -2;
                break;
            }
            $eliminationVar = $i;
        }
    }
    if ($eliminationVar != -2) {
        $win[0] = true;
        $win[1] = $eliminationVar;
        $win[2] = "Gracz wygrał poprzez eliminacje przeciwników.";
    }
    
    checkWin();
    mysqli_close($connection);
    function checkWin() {
        global $win, $gameData, $connection;
        if ($win[0] == true) {
            $conditionUser = array("0=1");
            for ($i = 0; $i < 4; $i++) {
                if ($gameData[4][$i] != 0) {
                    $conditionUser[] = "id =".$gameData[4][$i];
                } else {
                    break;
                }
            }
            $conditionUser = implode(" OR ",$conditionUser);
            $sqlUser = "UPDATE users SET inGame = 0 WHERE ".$conditionUser;
            $sql = 'UPDATE game SET gameStatus = 2, whosTour = 6, winner = "'.$win[1].":".$win[2].'" WHERE gameID = '.$_SESSION['gameId'];
            //echo $sql.";".$sqlUser;
            $connection -> multi_query($sql.";".$sqlUser);
            $readyQuerys = array();
            for ($i = 0; $i < 4; $i++) {
                if ($gameData[4][$i] == 0) {
                    continue;
                }
                $result = $connection -> query("SELECT statistic FROM users WHERE id = ".$gameData[4][$i]);
                $row = $result -> fetch_object();
                $stats = $row -> statistic;
                $stats = explode(":", $stats);

                $stats[0] = explode(";",$stats[0]);
                $stats[0][1] = intval($stats[0][1])+1; 
                $stats[0] = implode(";",$stats[0]);

                $stats[5] = explode(";",$stats[5]);
                if ($win[1] == $i) {
                    $stats[1] = explode(";",$stats[1]);
                    $stats[1][1] = intval($stats[1][1])+1; 
                } else {
                    $stats[4] = explode(";",$stats[4]);
                    $stats[4][1] = intval($stats[4][1])+1; 
                }
                $stats[5] = round($stats[1][1]/$stats[4][1],2);
                $stats[1] = implode(";",$stats[1]);
                $stats[4] = implode(";",$stats[4]);
                $stats[5] = implode(";",$stats[5]);
                
                $stats[2] = explode(";",$stats[2]);
                if (intval($stats[2][1]) < $gameData[11]) {
                    $stats[2][1] = $gameData[11];
                }
                $stats[2] = implode(";",$stats[2]);

                $stats[3] = explode(";",$stats[3]);
                if (intval($stats[3][1]) < $gameData[9]) {
                    $stats[3][1] = $gameData[11];
                }
                $stats[3] = implode(";",$stats[3]);
                $readyQuerys[] = 'UPDATE SET statistic = "'.implode(":", $stats).'" FROM users WHERE id = '.$gameData[4][$i];
            }
            $_SESSION['xD'] = $readyQuerys;
            $connection -> multi_query(implode(";",$readyQuerys));
            mysqli_close($connection);
        }
    }

?>
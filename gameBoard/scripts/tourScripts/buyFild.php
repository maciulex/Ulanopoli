<?php 
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    
    if (!isset($_GET['l'])) {
        echo "Fatal_Error";
        exit();
    }
    $lvlNumber = intval($_GET['l'])-1; 
    $fild = $gameData[6][$gameData[1]];
    if ($gameData[4][$gameData[1]] == $_SESSION['id']) {
        if ($gameData[0] == 1) {
            $result = $connection -> query("SELECT * FROM filds WHERE id = ".$fild);
            $row = $result -> fetch_object();
            $lvl = array($row->l1,$row->l2,$row->l3,$row->l4,$row->l5);
            unset($row, $result);
            switch($fild) {
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
                    echo $lvl[$lvlNumber];
                    $price;
                    $fildData = explode(":",$gameData[5][$fild]);
                    $fildData[0] = intval($fildData[0]);
                    $fildData[1] = intval($fildData[1]);
                    echo " ".$fildData[1] ." ". $lvlNumber;
                    //ulepszenie
                    if (intval($fildData[0]) == 0) {
                        //Kupienie pustego pola;
                        $price;
                        switch ($gameData[10][$gameData[1]]) {
                            case 0:
                                $price = 25000;
                            break;
                            case 1:
                                $price = 50000;
                            break;
                            case 2:
                                $price = 100000;
                            break;
                            case 3:
                                $price = 200000;
                            break;
                        }
                        if ($gameData[9][$gameData[1]] >= $price) {
                            $gameData[9][$gameData[1]] -= $price;
                            $fildData = ($gameData[1]+1).":".($gameData[10][$gameData[1]]).":".$fildData[2];
                            $gameData[5][$fild] = $fildData;
                            $gameData[10][$gameData[1]] += 1;
                            if ($gameData[10][$gameData[1]] > 1) {
                                $islands = array(4,14,18,25);
                                for ($i = 0; $i < 4; $i++) {    
                                    if ($islands[$i] == $fild) {
                                        continue;
                                    }
                                    $fildData = explode(":",$gameData[5][$islands[$i]]);
                                    if ($fildData[0] != $gameData[1]+1) {
                                        continue;
                                    } else {
                                        $fildData[1] = $gameData[10][$gameData[1]]-1;
                                        $gameData[5][$islands[$i]] = implode(":", $fildData);
                                    }
                                }
                            }
                        } else {
                            echo "ERROR to low money";
                        }
                    } else {
                        echo "ERROR can't buy someone else island";
                    }
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
                    if ($lvlNumber >= 0 && $lvlNumber <=4) {
                        echo $lvl[$lvlNumber];
                        $fildData = explode(":",$gameData[5][$fild]);
                        $fildData[0] = intval($fildData[0]);
                        $fildData[1] = intval($fildData[1]);
                        echo " ".$fildData[1] ." ". $lvlNumber;
                        //ulepszenie
                        if ($fildData[0] == $gameData[1]+1) {
                            if ($fildData[1] > $lvlNumber) {
                                echo "Error wrong lvl";
                                exit();
                            } else {
                                if ($gameData[9][$gameData[1]] < $lvl[$lvlNumber]) {
                                    echo "Error wrong money";
                                    exit();   
                                } else {
                                    $gameData[9][$gameData[1]] -= $lvl[$lvlNumber]-$lvl[$fildData[1]];
                                    $gameData[11][$gameData[1]] += ($lvl[$lvlNumber]-$lvl[$fildData[1]]);
                                    $fildData = ($gameData[1]+1).":".$lvlNumber.":".$fildData[2];
                                    $gameData[5][$fild] = $fildData;
                                }
                            }
                        } else if (intval($fildData[0]) == 0) {
                            //Kupienie pustego pola;
                            if ($gameData[9][$gameData[1]] < $lvl[$lvlNumber]) {
                                echo "Error to low lvl";
                                exit();   
                            } else {
                                $gameData[9][$gameData[1]] -= $lvl[$lvlNumber];
                                $fildData = ($gameData[1]+1).":".$lvlNumber.":".$fildData[2];
                                $gameData[5][$fild] = $fildData;
                            }
                        } else {
                            //Kupienie pola innego gracza
                            if ($gameData[9][$gameData[1]] < $lvl[$lvlNumber]*2) {
                                echo "Error";
                                exit();   
                            } else {
                                $gameData[9][$gameData[1]] -= $lvl[$lvlNumber]*2;
                                $gameData[11][$gameData[1]] -= $lvl[$lvlNumber];
                                $gameData[9][$fildData[0]-1] += $lvl[$lvlNumber]*2;
                                $gameData[9][$fildData[0]-1] += $lvl[$lvlNumber];
                                $fildData = ($gameData[1]+1).":".$lvlNumber.":".$fildData[2];
                                $gameData[5][$fild] = $fildData;
                            }
                        }
                    }
                break;
            }
            $sql = 'UPDATE game SET money = "'.implode(":",$gameData[9]).'", wealth = "'.implode(":", $gameData[11]).'", fildsNfo = "'.implode(";",$gameData[5]).'", eventCode = 2, islands ="'.implode(":",$gameData[10]).'" WHERE gameID = '. $_SESSION['gameId'];
            echo $sql;
            $connection -> query($sql);
        } else {
            echo "Error";
            exit();
        }
    } else {
        echo "Error";
        exit();
    }
    
    
?>
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
    $logsValue = '<div class="L_BuyFilds">';
    $lvlNumber = intval($_GET['l'])-1; 
    $fild = $gameData[6][$gameData[1]];
    $eventCode = 2;
    if ($gameData[4][$gameData[1]] == $_SESSION['id']) {
        if ($gameData[0] == 1) {
            $result = $connection -> query("SELECT * FROM filds WHERE id = ".$fild);
            $row = $result -> fetch_object();
            $lvl = array($row->l1,$row->l2,$row->l3,$row->l4,$row->l5);
            unset($row, $result);
            switch($fild) {
                case 0:
                    //start
                    $logsValue .= "<span>Gracz próbuje kupić pole startu ERROR: nie dozwolona akcja</span>";
                break;
                case 8:
                    //bezludna wyspa
                    switch ($_GET['l']) {
                        case "1":
                            //kupienie wolności za 200k
                            if ($gameData[9][$gameData[1]] < 200000) {
                                $logsValue .= "<span>Gracz próbuje wykupić wolność ale go nie stać XD!</span>";
                            } else {
                                $gameData[9][$gameData[1]] -= 200000;
                                $gameData[11][$gameData[1]] -= 200000;
                                $gameData[3][$gameData[1]] = 0;
                                $eventCode = 0;
                                $logsValue .= "<span>Gracz wykupuje wolność. Stan konta po transakcji: ".$gameData[9][$gameData[1]].", przed: ".($gameData[9][$gameData[1]]+200000)."</span>";
                            }
                        break;
                        case "2":
                            //użycie karty
                            
                        break;
                        default:
                            $logsValue .= "<span>Gracz próbuje zrobić coś nielegalnego!</span>";
                        break;
                    }
                break;
                case 4:
                case 14:
                case 18:
                case 25:
                    //wyspy
                    $logsValue .= "<p>Gracz próbuje kupić wyspę</p>";
                    echo $lvl[$lvlNumber];
                    $price;
                    $fildData = explode(":",$gameData[5][$fild]);
                    $fildData[0] = intval($fildData[0]);
                    $fildData[1] = intval($fildData[1]);
                    echo " ".$fildData[1] ." ". $lvlNumber;
                    //ulepszenie
                    if ($fildData[0] == "0") {
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
                        $logsValue .= "<span>Cena: ".$price."</span><span>Pieniądze: ".$gameData[9][$gameData[1]]."</span>";
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
                            $logsValue .= "<span>Powodzenie!</span>";
                            $logsValue .= "<span>Saldo po operacji: ".$gameData[9][$gameData[1]]."</span>";
                            $logsValue .= "<span>Liczba wysp: ".$gameData[10][$gameData[1]]."</span>";
                            //MAYBY WYGRANA
                        } else {
                            echo "ERROR to low money";
                            $logsValue .= "<span>Błąd: Za mało pieniędzy by kupić pole!</span>";
                        }
                    } else {
                        echo "ERROR can't buy someone else island";
                        $logsValue .= "<span>Błąd: Za nie da się kupić czyjejś wyspy!</span>";
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
                            $logsValue .= "<p>Gracz próbuje ulepszyć pole</p>";
                            if ($fildData[1] > $lvlNumber) {
                                echo "Error wrong lvl";
                                $logsValue .= "<span>Błąd: Nie poprawny poziom, nie da się kupić niższego poziomu</span>";
                                updateLogs();
                                exit();
                            } else {
                                if ($gameData[9][$gameData[1]] < $lvl[$lvlNumber]) {
                                    $logsValue .= "<span>Błąd za mało pieniędzy, posiadane: ".$gameData[9][$gameData[1]].", wymagane: ".$lvl[$lvlNumber]."</span>";
                                    echo "Error wrong money";
                                    updateLogs();
                                    exit();   
                                } else {
                                    $logsValue .= "<span>Cena: ".$lvl[$lvlNumber]."</span><span>Pieniądze: ".$gameData[9][$gameData[1]]."</span>";
                                    $gameData[9][$gameData[1]] -= $lvl[$lvlNumber]-$lvl[$fildData[1]];
                                    $gameData[11][$gameData[1]] += ($lvl[$lvlNumber]-$lvl[$fildData[1]]);
                                    $fildData = ($gameData[1]+1).":".$lvlNumber.":".$fildData[2];
                                    $gameData[5][$fild] = $fildData;
                                    $logsValue .= "<span>Powodzenie!</span>";
                                    $logsValue .= "<span>Saldo po operacji: ".$gameData[9][$gameData[1]].", Majątek po operacji: ".$gameData[11][$gameData[1]]."</span>";
                                }
                            }
                        } else if (intval($fildData[0]) == 0) {
                            //Kupienie pustego pola;
                            $logsValue .= "<p>Gracz próbuje kupić puste pole</p>";
                            if ($gameData[9][$gameData[1]] < $lvl[$lvlNumber]) {
                                echo "Error to low money";
                                $logsValue .= "<span>Błąd za mało pieniędzy, posiadane: ".$gameData[9][$gameData[1]].", wymagane: ".$lvl[$lvlNumber]."</span>";
                                updateLogs();
                                exit();   
                            } else {
                                $logsValue .= "<span>Cena: ".$lvl[$lvlNumber]."</span><span>Pieniądze: ".$gameData[9][$gameData[1]]."</span>";
                                $gameData[9][$gameData[1]] -= $lvl[$lvlNumber];
                                $fildData = ($gameData[1]+1).":".$lvlNumber.":".$fildData[2];
                                $gameData[5][$fild] = $fildData;
                                $logsValue .= "<span>Powodzenie!</span>";
                                $logsValue .= "<span>Saldo po operacji: ".$gameData[9][$gameData[1]].", Majątek po operacji: ".$gameData[11][$gameData[1]]."</span>";
                            }
                        } else {
                            //Kupienie pola innego gracza
                            $logsValue .= "<p>Gracz próbuje kupić pole innego gracza</p>";
                            if ($gameData[9][$gameData[1]] < $lvl[$lvlNumber]*2) {
                                echo "Error";
                                $logsValue .= "<span>Błąd za mało pieniędzy, posiadane: ".$gameData[9][$gameData[1]].", wymagane: ".$lvl[$lvlNumber]."</span>";
                                updateLogs();
                                exit();   
                            } else {
                                $logsValue .= "<span>Cena: ".$lvl[$lvlNumber]."</span><span>Pieniądze: ".$gameData[9][$gameData[1]]."</span>";
                                $gameData[9][$gameData[1]] -= $lvl[$lvlNumber]*2;
                                $gameData[11][$gameData[1]] -= $lvl[$lvlNumber];
                                $gameData[9][$fildData[0]-1] += $lvl[$lvlNumber]*2;
                                $gameData[9][$fildData[0]-1] += $lvl[$lvlNumber];
                                $fildData = ($gameData[1]+1).":".$lvlNumber.":".$fildData[2];
                                $gameData[5][$fild] = $fildData;
                                $logsValue .= "<span>Powodzenie!</span>";
                                $logsValue .= "<span>Kupujący (".($gameData[1]+1).") - Saldo po operacji: ".$gameData[9][$gameData[1]].", Majątek po operacji: ".$gameData[11][$gameData[1]]."</span>";
                                $logsValue .= "<span>Sprzedawca (".$fildData[0].") - Saldo po operacji: ".$gameData[9][$fildData[0]-1].", Majątek po operacji: ".$gameData[9][$fildData[0]-1]."</span>";
                            }
                        }
                    } else {
                        $logsValue .= "<span>Błąd: Nie można kupić - nie poprawny poziom: ".($lvlNumber+1)."</span>";
                    }
                break;
            }
            $logsValue .= "</div>";
            $sql = 'UPDATE game SET money = "'.implode(":",$gameData[9]).'", wealth = "'.implode(":", $gameData[11]).'", fildsNfo = "'.implode(";",$gameData[5]).'", eventCode = '.$eventCode.', islands ="'.implode(":",$gameData[10]).'", movesCodes = "'.implode(":", $gameData[3]).'" WHERE gameID = '. $_SESSION['gameId'];
            $sql2 = 'UPDATE game SET logs = CONCAT(logs, \''.$logsValue.'\') WHERE gameID = '.$_SESSION["gameId"];
            $connection -> multi_query($sql.";".$sql2);
        } else {
            echo "Error";
            exit();
        }
    } else {
        echo "Error";
        exit();
    }
    function updateLogs() {
        $logsValue .= "</div>";
        $sql = 'UPDATE game SET logs = CONCAT(logs, \''.$logsValue.'\') WHERE gameID = '.$_SESSION["gameId"];
        $connection -> query($sql);
    }
    
?>
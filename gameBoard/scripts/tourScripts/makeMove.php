<?php 
    $gameData = array();
    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    $logsValue = '<div class="L_MakeMove">';
    $trow1=-1;
    $trow2=1;
    $eventCode=1;
    $rounds = "";
    if ($gameData[4][$gameData[1]] == $_SESSION['id']) {
        if ($gameData[0] == 0) {
            if ($gameData[3][$gameData[1]] == 0) {
                $trow1 = rand(1,6);
                $trow2 = rand(1,6);
                //$trow1 = 0;
                //$trow2 = 0;
                $eventCode = 1;
                $logsValue .= "<span>Rzut kostkami: ".$trow1.", ".$trow2."</span>";
                $gameData[6][$gameData[1]] += $trow1 + $trow2;
                if ($gameData[6][$gameData[1]] > 31) {
                    $gameData[6][$gameData[1]] -= 31;
                    $gameData[9][$gameData[1]] += 200000;
                    $gameData[11][$gameData[1]] += 200000;
                    $gameData[14][$gameData[1]] += 1;
                    $rounds = ', rounds = "'.implode(":",$gameData[14]).'"';
                    $logsValue .= "<span>Gracz przekroczył start! Dodanie 200k Saldo po operacji: ".$gameData[9][$gameData[1]].", przed operacją: ".($gameData[9][$gameData[1]]-200000)."</span>";
                } 
                $fildInfo = explode(":",$gameData[5][$gameData[6][$gameData[1]]]);
                $fildInfo[0] = intval($fildInfo[0]);
                $fildInfo[1] = intval($fildInfo[1]);
                if ($fildInfo[0] != $gameData[1]+1 && $fildInfo[0] != 0) {
                    $data = array();
                    $sql = "SELECT * FROM filds WHERE id = ".$gameData[6][$gameData[1]];
                    $result = $connection -> query($sql);
                    while ($row = $result -> fetch_object()) {
                        $data[] = $row->l1;
                        $data[] = $row->l2;
                        $data[] = $row->l3;
                        $data[] = $row->l4;
                        $data[] = $row->l5;
                        $data[] = $row->l1;
                    }
                    $price = 0;
                    if ($gameData[12] != $gameData[6][$gameData[1]]) {
                        $price = $data[$fildInfo[1]]/2;
                        $gameData[9][$gameData[1]] -= $price;
                        $gameData[11][$gameData[1]] -= $price;
                        $gameData[9][$fildInfo[0]-1] += $price;
                        $gameData[11][$fildInfo[0]-1] += $price;
                    } else {
                        $price = ($data[$fildInfo[1]]/2)*floatval($fildInfo[2]);
                        $gameData[9][$gameData[1]] -= $price;
                        $gameData[11][$gameData[1]] -= $price;
                        $gameData[9][$fildInfo[0]-1] += $price;
                        $gameData[11][$fildInfo[0]-1] += $price;
                    }
                    $logsValue .= "<span>Gracz(".($gameData[1]+1).") wylądował na polu innego gracza(".$fildInfo[0].").</span>";
                    $logsValue .= "<span>Koszt: ".($data[$fildInfo[1]]/2)."</span>";
                    $logsValue .= "<span>Saldo gracza: ".$gameData[9][$gameData[1]].", przed: ".($gameData[9][$gameData[1]]+$price)."</span>";
                    $logsValue .= "<span>Saldo właściciela pola: ".$gameData[9][$fildInfo[0]-1].", przed: ".($gameData[9][$fildInfo[0]-1]-$price)."</span>";

                }
            }
            switch ($gameData[6][$gameData[1]]) {
                case 30:
                    $logsValue .= "<span>Gracz wylądował na polu podatku!</span>";
                    $logsValue .= "<span>Opłata wynosi 5% majątku (".($gameData[11][$gameData[1]]*0.05).")</span>";
                    $logsValue .= "<span>Saldo przed operacją: ".$gameData[9][$gameData[1]].", po operacji: ".($gameData[9][$gameData[1]]-($gameData[11][$gameData[1]]*0.05))."</span>";
                    $gameData[9][$gameData[1]]-=($gameData[11][$gameData[1]]*0.05);
                    $gameData[11][$gameData[1]]-=($gameData[11][$gameData[1]]*0.05);
                break;
                case 8:
                    if ($gameData[3][$gameData[1]] != 0) {
                        $gameData[3][$gameData[1]] -= 1;
                        $logsValue .= "<span>Gracz jest na Bezludnej wyspie!</span>";
                        $logsValue .= "<span>Może zapłacić 200k, poczekać jeszcze ".$gameData[3][$gameData[1]]." tury lub użyć karty jeżeli ma.</span>";
                    } else {
                        $gameData[3][$gameData[1]] = 3;
                        $logsValue .= "<span>Gracz trafił na Bezludna wyspę!</span>";
                        $logsValue .= "<span>Może zapłacić 200k, poczekać 3 tury lub użyć karty jeżeli ma.</span>";
                    }
                break;
                case 16:
                    $logsValue .= "<span>Gracz Wylądował na polu Mistrzostw świata!</span>";
                break;
                case 24:
                    $logsValue .= "<span>Gracz Wylądował na polu Podróży!</span>";
                break;
            }
            echo $trow1.":".$trow2;
            if ($gameData[11][$gameData[1]] < 0) {
                //endthisguygame
            } else if ($gameData[9][$gameData[1]] < 0) {
                $eventCode = 3;
                echo ":true";
                $logsValue .= "<span class=\"L_SellMessage\">Gracz musi sprzedać pola ponieważ jest na minusie (".$gameData[9][$gameData[1]].")!</span>";
            } else {
                echo ":false";
            }
            $logsValue .= "</div>";
            $sql = 'UPDATE game SET money = "'.implode(":",$gameData[9]).'",wealth="'.implode(":",$gameData[11]).'", place = "'.implode(":",$gameData[6]).'", trowed = "'.$trow1.$trow2.'", eventCode = '.$eventCode.', movesCodes = "'.implode(":",$gameData[3]).'"'.$rounds.' WHERE gameID = '.$_SESSION["gameId"];
            //echo $sql;
            $sql2 = 'UPDATE game SET logs = CONCAT(\''.$logsValue.'\',logs) WHERE gameID = '.$_SESSION["gameId"];
            $connection -> multi_query($sql.";".$sql2);
            exit();
        } else {
            echo "Error";
            exit();
        }
    } else {
        echo "Error";
        exit();
    }
    
    
?>
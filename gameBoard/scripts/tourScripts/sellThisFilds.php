<?php 
    session_start();
    $gameData = array();

    if (!(@include_once "tourBaseDataGet.php")) {
        echo "Fatal_Error";
        exit();
    } 
    if (!isset($_SESSION["id"]) || !isset($_SESSION["gameId"])) {
        echo "Fatal_Error";
        mysqli_close($connection);
        exit();
    }
    if (!isset($_POST['data'])) {
        echo "Fatal_Error_No_Filds_Sends";
        mysqli_close($connection);
        exit();
    }
    $logsValue = "";
    //echo $_POST['data'];      
    $data = explode(":", $_POST['data']);
    $filds = array();
    $sql = "SELECT * FROM filds WHERE 1 ORDER BY id ASC";
    $result = $connection -> query($sql);
    $i = 0;
    while ($row = $result -> fetch_object()) {
        $filds[$i] = array();
        $filds[$i][] = $row->l1;
        $filds[$i][] = $row->l2;
        $filds[$i][] = $row->l3;
        $filds[$i][] = $row->l4;
        $filds[$i][] = $row->l5;
        $filds[$i][] = $row->name;
        $i++;
    }
    $fildsNames = array();
    $fildsMoney = 0;
    for ($i = 0; $i < count($data); $i++) {
        $fild = explode(":",$gameData[5][intval($data[$i])]);
        if ($fild[0] != intval($gameData[1])+1) {
            echo "END0";
            continue;
        }
        $fildsNames[] = $filds[intval($data[$i])][5];
        //echo ";".$data[$i].";".$fild[1].";";
        $fildsMoney += intval($filds[intval($data[$i])][intval($fild[1])]);
        $gameData[5][intval($data[$i])] = "0:0:".$fild[2];
    }
    if ($fildsMoney + $gameData[9][$gameData[1]] < 0) {
        //endthisguygame
        echo "END1";
    } else {
        $logsValue .= "<span>Gracz sprzedaje pola: ".implode(", ", $fildsNames)." o wartości: ".$fildsMoney."</span>";
        $logsValue .= "<span>Saldo przed operacją: ".$gameData[9][$gameData[1]]." Saldo po operacji: ".($gameData[9][$gameData[1]] + $fildsMoney)."<span>";
        $gameData[9][$gameData[1]] += $fildsMoney;
        $sql = 'UPDATE game SET money = "'.implode(":",$gameData[9]).'", wealth = "'.implode(":", $gameData[11]).'", fildsNfo = "'.implode(";",$gameData[5]).'", eventCode = 2 WHERE gameID = '. $_SESSION['gameId'];
        $sql2 = 'UPDATE game SET logs = CONCAT(\''.$logsValue.'\',logs) WHERE gameID = '.$_SESSION["gameId"];
        $connection -> multi_query($sql.";".$sql2);
        mysqli_close($connection);
        echo "LIFU";
    }    
?>
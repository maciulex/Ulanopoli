<?php
    session_start();
    if (!isset($_SESSION["id"]) || !isset($_SESSION["gameId"])) {
        echo "Error";
        exit();
    }
    if (!(include_once "../../base.php")) {
        echo "Error";
        exit();
    } 
    $connection = new mysqli ($host, $db_user, $db_passcode, $db_name);
    if ($connection -> connect_errno > 0) {
        echo "Error";
        exit();
    } else {
        $sql = "SELECT * FROM filds WHERE 1";
        $result = $connection -> query($sql);
        while ($row = $result -> fetch_object()) {
            echo $row->id."::";
            echo $row->l1.":";
            echo $row->l2.":";
            echo $row->l3.":";
            echo $row->l4.":";
            echo $row->l5.":";
            echo $row->l1.";";
        }
    }
?>
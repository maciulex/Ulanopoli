<?php 
    session_start();
    if (!isset($_SESSION['gameId'])) {
        echo "Error";
        exit();
    }
    require_once "../../base.php";
    $connection = new mysqli($host, $db_user, $db_passcode, $db_name);
    if ($connection -> connect_errno > 0) {
        echo "ERROR";
    } else {
        $sql = "SELECT logs FROM game WHERE gameID = ". $_SESSION['gameId'];
        $res = $connection -> query($sql);
        $row = $res->fetch_object();
        echo $row->logs;
        mysqli_close($connection);
        exit();
    }

?>
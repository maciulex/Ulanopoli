<?php
    session_start();
    if (!isset($_SESSION['logged']) || !isset($_SESSION['serverName'])) {
        header("Location: ../index.php");
        exit();
    }
    require_once "../base.php";
    $connection = new mysqli($host, $db_user, $db_passcode, $db_name);
    if ($connection->connect_errno !=0) {
        echo "Error: ".$connection->connection_errno;
    } else {
        $date = date('H:i:s');
        $datus = '0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1;0:0:1';
        $sql = "UPDATE game SET gameStatus = 1, startTime = ?, tour = 1,fildsNfo = ?, eventCode=0 WHERE gameID = ?";
        $stmt = $connection -> prepare($sql);
        $stmt -> bind_param("ssi", $date, $datus ,$_SESSION['gameId']);
        $stmt -> execute();
        $stmt -> close();
        mysqli_close($connection);
    }

?>
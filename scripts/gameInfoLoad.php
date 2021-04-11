<?php
    session_start();
    if (!isset($_SESSION['logged']) || !isset($_SESSION['serverName'])) {
        header("Location: index.php");
        exit();
    }
    require_once "../base.php";
    $connection = new mysqli($host, $db_user, $db_passcode, $db_name);
    if ($connection->connect_errno !=0) {
        echo "Error: ".$connection->connection_errno;
    } else {
        $sql = "SELECT serverName, gameStatus, activePlayer, maxPlayers, players FROM game WHERE gameID = ?";
        $stmt = $connection -> prepare($sql);
        $stmt -> bind_param("i", $_SESSION['gameId']);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($_SESSION['serverName'], $_SESSION['serverStatus'],$_SESSION['serverActivplayers'],$_SESSION['maxPlayers'],$_SESSION['Players']);
        $stmt -> fetch();
        $stmt -> close();
        echo $_SESSION['serverName'].";".$_SESSION['serverStatus'].";".$_SESSION['serverActivplayers'].";".$_SESSION['Players'].";".$_SESSION['maxPlayers'];
        mysqli_close($connection);
    }

?>
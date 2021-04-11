<?php
    session_start();
    $stats = $_SESSION['gameStatsPlayer'];
    $state1 = $_POST["s1"];
    $state2 = $_POST["s2"];
    $state3 = $_POST["s3"];

    if ($state1 == $state2 || $state1 == $state3 || $state2 == $state1 || $state2 == $state3) {
        $_SESSION['error'] = "Statystyki nie mogą być takie same!";
        header("Location: ../profile.php");
        exit();
    }
    $stats = explode(":",$stats);

    $text = "";
    for ($i = 1; $i <= 6; $i++) {
            $luls = explode(";", $stats[$i-1]);
            if ($state1 == $i) {
                $text .= "1.1;".$luls[1];
            } else if ($state2 == $i) {
                $text .= "1.2;".$luls[1];
            } else if ($state3 == $i) {
                $text .= "1.3;".$luls[1];
            } else {
                $text .= "0;".$luls[1];
            }
            if ($i != 6) {$text .= ":";};
    }

    $_SESSION['gameStatsPlayer'] = $text; 
    require_once "../base.php";

    $connection = new mysqli($host, $db_user, $db_passcode, $db_name);

    if ($connection->connect_errno != 0) {
        $_SESSION["error"] = "Error Bazy Danych!";
        header("Location: ../profile.php");
        exit();
    } else {
        $id = $_SESSION['id'];
        $sql = "UPDATE users SET statistic = ? WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt -> bind_param("si", $text ,$id);
        $stmt -> execute();
        $stmt -> close();
        mysqli_close($connection);
        header("Location: ../profile.php");
    }

    
?>
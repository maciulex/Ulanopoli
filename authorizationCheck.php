<?php
    if (!isset($connection) || !isset($PageName) || !isset($MainPageRoot)) {
        exit();
    }
    if (!isset($_SESSION["PlayerNickName"]) || !isset($_SESSION["LogStatus"])) {
        header($MainPageRoot);
        exit();
    }
    $sql = "SELECT authCode, authDate FROM users WHERE nickname = ?";

?>
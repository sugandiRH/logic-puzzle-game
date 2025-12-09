<?php
session_start();

// Session timeout (10 minutes of inactivity)
$timeout_duration = 60000;

if (isset($_SESSION['LAST_ACTIVITY']) &&
    (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {

    session_unset();
    session_destroy();
    header("Location: ../loging_page/loginPG.php?timeout=1");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time();
?>

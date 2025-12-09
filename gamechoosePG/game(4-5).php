<?php include '../session_config.php'; ?>
<?php

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game For Age 4-5</title>

    <link rel="stylesheet" href="game(4-5).css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <div class="wrapper">
        <div class="image-box">
            <div class="title">
                <h2>Hello, <?php echo $_SESSION['username']; ?>!</h2>
                <h3>Choose Your Game</h3>
            </div>
            <div class="image"></div>
        </div>

        <div class="chooseBox">
            <div class="counting">
                <a href="../game4-5/countingGame_Easy.php"><h1>Counting</h1></a>
            </div>

            <div class="mathOperation">
                <a href=""><h1>Math <br> Operation</h1></a>
            </div>
        </div>

        <div class="side-bar">
            <div class="icon">
                <img src="../assent/userIcon.jpg" alt="">
            </div>
            <div class="icon">
                <img src="../assent/scoreBoardIcon.jpg" alt="">
            </div>

            <div class="logout">
                <a href="../loging_page/loginPG.php"><img src="../assent/logoutIcon.jpg" alt=""></a>
            </div>
        </div>
    </div>
</body>
</html>
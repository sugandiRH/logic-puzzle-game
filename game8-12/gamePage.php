<?php include '../session_config.php'; ?>
<?php
    if (!isset($_SESSION['username'])) {
        header("Location: ../loging_page/loginPG.php");
        exit();
    }
?>

<!-- for display game level -->
<?php
    include "../DB_connection";
    $user_id = $_SESSION['user_id'];
    
    // Initialize variables to prevent undefined errors
    $current_level = 1;
    $image_path = '';
    $wait_time = 0;
    $current_time = time();
    $num1 = '';
    $num2 = '';
    $operation = '';
    $answer = '';
    
    $sql = "SELECT level, wait_time from player_level WHERE user_id = $user_id AND game_name = 'math'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $wait_time = strtotime($row['wait_time']) ?: 0;
        $current_level = $row['level'];
    }

    $wait_threshold = 900;
    if (($current_time - $wait_time) < $wait_threshold) {
        echo "<script>
            window.onload = function() {
                document.getElementById('popup').classList.add('active');
            }
          </script>";
    }
    else{
        $gameSQL = "SELECT * from gamelevel_math WHERE level = $current_level";
        $gameResult = mysqli_query($conn, $gameSQL);

        if (mysqli_num_rows($gameResult) == 1) {
            $gameRow = mysqli_fetch_assoc($gameResult);
            $num1 = $gameRow['num1'];
            $num2 = $gameRow['num2'];
            $operation = $gameRow['operetion'];
            $answer = $gameRow['answer'];
            
        } 
        else{
            echo "No game level found for level number: " . $current_level;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="gamePage.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=favorite" />
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div class="wrap">
            <label for="" id ="titleLable"></label>
            <div class="image-box">
                <!-- <img src="../assent/userIcon.jpg" alt=""> -->
                <div>
                    <div class="numDiv">
                        <label for="" id="num1"><?php echo $num1; ?></label>
                    </div>
                    <div class="numDiv">
                        <label for="" id="operation"><?php echo $operation; ?></label>
                    </div>
                    <div class="numDiv">
                        <label for="" id="num2"><?php echo $num2; ?></label>
                    </div>
                </div>
            </div>
            <div class="board">
                <div class="number-board">
                    <?php 
                        for ($i = 0; $i < 10; $i++) {
                            echo "<div class='number'> <h1> $i </h1> </div>";
                        }
                    ?>    
                </div>

                <div class="selection-area">
                    <div class="selectedNumbers" id="selectedNumbers">Selected: <input type ="text" class="selectNum" id="selectNum" placeholder="None"></input></div>
                    <button class="checkBtn" id="checkBtn" onclick="checkNum(<?php echo $answer; ?>)">CHECK</button>
                    <button class="clearBtn" id="clearBtn" onclick="clearNum()">CLEAR</button>
                </div>
            </div>
        </div>

        <div class="side-bar">

            <div class="show-level">
                <div class="emoji">
                    <img src="../assent/icon.png" alt="">
                </div>
                <div class="level">
                    <p><?php echo $current_level; ?><p>
                </div>
            </div>

            <div class="lives">
                <i class="fa fa-heart" id= "heart1"></i>
                <i class="fa fa-heart" id= "heart2"></i>
                <i class="fa fa-heart" id= "heart3"></i>
            </div>

            <div class="message-box">
                <h3>puzzelX</h3>
                <h2>Hello, <?php echo $_SESSION['username']; ?>!</h2>
            
                <div id="message">
                    <p id="message1">Select 1 or 2 numbers <br> Then check!</p>
                    <p id="message2">Good Luck,<br> let's Go!</p>
                    <button onclick=goNextLevel() id="nextBtn">Next Level</button>

                </div>
            </div>

            <div class="icon-bar">
                <div class="logout">
                    <a href="../loging_page/loginPG.php"><img src="../assent/logoutIcon.jpg" alt=""></a>
                </div>
            </div>
        </div>
    </div>

    <!-- this is for popup box -->
     <div class="popup" id ="popup">
        <div class="overlay"></div>
        <div class="popup-content">
            <h2>It's Over!</h2>
            <p>Try After 15 minute or Play Banana Game</p>
            <img src="../assent/userIcon.jpg" alt="">
            <div class="button">
                <!-- <button id="replayBtn">Replay</button> -->
                <button id="bananaGameBtn">Banana Game</button>
                <!-- <button id="backBtn">Back</button> -->
            </div>            
        </div>
     </div>

    <script src="gameMath.js"></script>
</body>
</html>
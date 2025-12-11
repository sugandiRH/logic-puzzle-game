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
    $image_count = 0;
    $image_path = '';
    $position_1 = '';
    $position_2 = '';
    $position_3 = '';
    $item_count = 0;
    
    $sql = "SELECT level from player_level WHERE user_id = $user_id AND game_name = 'counting'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $current_level = $row['level'];
    }

    $gameSQL = "SELECT * from game_levels WHERE level_number = $current_level";
    $gameResult = mysqli_query($conn, $gameSQL);

    if (mysqli_num_rows($gameResult) == 1) {
        $gameRow = mysqli_fetch_assoc($gameResult);
        $image_path = $gameRow['image_path'];
        $position_1 = $gameRow['position_1'];
        $position_2 = $gameRow['position_2'];
        $position_3 = $gameRow['position_3'];
        $item_count = $gameRow['item_count'];
    } 
    else{
        echo "No game level found for level number: " . $current_level;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age 4-5 Counting Game</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=favorite" />
    <link rel="stylesheet" href="age4-5.css">
    <!-- <link rel="stylesheet" href="gameStyle.css"> -->
    
</head>
<body>

    <div class="wrapper">
        <div class="wrap">

            <!-- image cont -->
            <div class="image-box">
                <?php
                    if ($item_count > 0) {
                        // Loop to generate the specified number of divs
                        for ($i = 1; $i <= $item_count; $i++) {
                            echo "<div class='myDiv'> <img class='animated tada' src='$image_path'> </div>";
                        }
                    }
                ?>
            </div>

            <div class="board">
                <div class="number-board">
                    <?php 
                    
                        $numList= array($position_1, $position_2, $position_3);
                        for ($i = 0; $i < 3; $i++) {
                            echo "<div class='number'> <h1> $numList[$i] </h1> </div>";
                        }
                    ?>    
                </div>

                <div class="selection-area">
                    <input type ="hidden" class="selectNum" id="selectNum" placeholder="None"></input>
                    <button class="checkBtn" id="checkBtn" onclick="checkNum(<?php echo $item_count; ?>)">CHECK</button>
                    <!-- <button class="clearBtn" id="clearBtn" onclick="clearNum()">CLEAR</button> -->
                </div>
            </div>    

        </div>

        
        <div class="side-bar">

            <!-- <div class="icon-bar">
                <div class="icon">
                    <img src="../assent/userIcon.jpg" alt="">
                </div>
                <div class="icon">
                    <img src="../assent/scoreBoardIcon.jpg" alt="">
                </div>
            </div> -->

            <div class="mode-div">
                <div class="button-box">
                    <div id='btn' class="btn"></div>
                    <button onclick="leftClick()" type="button" class="toggle-btn">Easy</button>
                    <button onclick="rightClick()" type="button" class="toggle-btn">Hard</button>
                </div>
            </div>

            <div class="show-level">
                <div class="emoji">
                    <img src="../assent/icon.png" alt="">
                </div>
                <div class="level">
                    <p><?php echo $current_level ?><p>
                </div>
            </div>

            <div class="lives">
                <i class="fa fa-heart" id= "heart1"></i>
                <i class="fa fa-heart" id= "heart2"></i>
                <!-- <i class="fa fa-heart" id= "heart3"></i> -->
                <!-- <div class="heart" id="heart1">
                    <div class="pluse"></div>
                </div> -->
            </div>

            <div class="message-box">
                <h3>puzzelX</h3>
                <h2>Hello, <?php echo $_SESSION['username']; ?>!</h2>
            
                <div id="message">
                    <p id="message1"></p>
                    <p id="message2"></p>
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
            <p>Do You Wonna Play Again?</p>
            <img src="../assent/userIcon.jpg" alt="">
            <div class="button">
                <button id="replayBtn">Replay</button>
                <!-- <button id="nextLevelBtn">Next Level</button> -->
                <button id="backBtn">Back</button>
            </div>            
        </div>
     </div>

    <script src="modeChange.js"></script>
    <script src="scriptEasy.js"></script>
</body>
</html>
<?php include '../session_config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age 4-5 Counting Game</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="wrapper">
        <div class="wrap">

            <!-- image cont -->
            <?php
                $count=10;
                if ($count > 0) {
                    // Loop to generate the specified number of divs
                    for ($i = 1; $i <= $count; $i++) {
                        echo "<div class='myDiv'> <img class='animated tada' src='../assent/userIcon.jpg'> </div>";
                    }
                }
            ?>

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
                    <button class="checkBtn" id="checkBtn" onclick="checkNum()">CHECK</button>
                    <button class="clearBtn" id="clearBtn" onclick="clearNum()">CLEAR</button>
                </div>
            </div>    

        </div>
    </div>

    <script src="scriptHard.js"></script>
</body>
</html>
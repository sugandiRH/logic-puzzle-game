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
                        $numList= array(1,2,3);
                        for ($i = 0; $i < 3; $i++) {
                            echo "<div class='number'> <h1> $numList[$i] </h1> </div>";
                        }
                    ?>    
                </div>

                <div class="selection-area">
                    <input type ="hidden" class="selectNum" id="selectNum" placeholder="None"></input>
                    <button class="checkBtn" id="checkBtn" onclick="checkNum()">CHECK</button>
                    <!-- <button class="clearBtn" id="clearBtn" onclick="clearNum()">CLEAR</button> -->
                </div>
            </div>    

        </div>
    </div>

    <script src="scriptEasy.js"></script>
</body>
</html>
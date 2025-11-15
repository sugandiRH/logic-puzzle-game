<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Begginer Level Game Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="begginer.css">

</head>
<body>

    <!-- side bar -->
    <div class="container">
        <div class="navigation">
            <div class="logo"></div>
            <ul class="menu">
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bx-user'></i></span>
                        <span class="title">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bx-stopwatch' ></i></span>
                        <span class="title">Timer</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bx-trophy' ></i></span>
                        <span class="title">Challenge</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bxs-dashboard' ></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>  
                <li class="logout">
                    <a href="#">
                        <span class="icon"><i class='bx bx-log-out'></i></span>
                        <span class="title">Logout</span>
                    </a>
                </li>              
            </ul>   
        </div>

        <!-- MAIN AREA -->
        <div class="main-container">
            <div class="header-wrapper">
                <h2>Count The Images!</h2>   
            </div>

            <section class="game">
                <div class="game-info">
                    <div class="life">
                        Life: <span id="life"><i class='bx bxs-heart' ></i></span>
                        <span id="life"><i class='bx bxs-heart' ></i></span>
                        <span id="life"><i class='bx bxs-heart' ></i></span>
                    </div>
                    <div class="score">
                        Score: <span id="score">0</span>
                    </div>
                    
                    <div class="timer">
                        <!-- <span id="minutes">00</span>:<span id="seconds">00</span> -->
                    </div>
                </div>

                <div class="game-area">

                    <div class="images-container" id="images-container">
                        <!-- Images will be dynamically added here -->
                    </div>
                    <div class="keypad">
                        <button class="num-btn">1</button>
                        <button class="num-btn">2</button>
                        <button class="num-btn">3</button>
                        <button class="num-btn">4</button>
                        <button class="num-btn">5</button>
                        <button class="num-btn">6</button>
                        <button class="num-btn">7</button>
                        <button class="num-btn">8</button>
                        <button class="num-btn">9</button>
                        <button class="num-btn">0</button>
                        
                    </div>
                    <div class="input-area">
                        <button class="clear-btn">Clear</button>
                        <!-- Hidden input to store the selected number -->
                        <input type="hidden" id="answer" />
                        <button class="submit-btn">check</button>
                    </div>
                </div>
            </section>
        </div>
        
    </div>
       
</body>
</html>
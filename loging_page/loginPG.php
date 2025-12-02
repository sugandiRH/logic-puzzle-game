<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS -->
    <link rel="stylesheet" href="login_style.css">

</head>
<body>
    <div class="wrapper">
        <form action="login_process.php" method="POST">
            <h1>Login</h1>

            <?php 
                session_start();
                if(isset($_SESSION['log_error'])){
                    echo "
                    <div class='alert-box'>
                        <span class='close-btn' onclick='this.parentElement.style.display=\"none\";'>&times;</span>
                        <p>".$_SESSION['log_error']."</p>
                    </div>";
                    unset($_SESSION['log_error']);
                }
            ?>

            <div class="input-box">
                <input type="text" placeholder="User Name" required name="username">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required name="password">
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-frogot">
                <label for="">
                    <input type="checkbox" name="remember">Remember Me
                </label>
                <!-- <a href="#">Frogot Password</a> -->
            </div>

            <button type="submit" class="btn">Get Start</button>
            <div class="register-link">
                <p>Don't have an account? <a href="../register_page/register_page.php">Register</a> </p>
            </div>

        </form>
    </div>
</body>
</html>
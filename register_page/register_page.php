<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style_registerPG.css">

</head>
<body>
    <div class="wrapper">
        <form action="register_process.php" method="POST">
            <h1>Welcome Buddy</h1>

            <?php 
            if(isset($_SESSION['reg_error'])){
                echo "<p style='color:red; text-align:center;'>".$_SESSION['reg_error']."</p>";
                unset($_SESSION['reg_error']);
            }
            ?>

            <div class="input-box">
                <input type="text" placeholder="User Name" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="number" placeholder="Age" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="int" placeholder="Password" required>
                <i class='bx bxs-calendar' ></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Confirm Password" required>
                <i class='bx bxs-envelope'></i>
            </div>

            <button type="submit" class="btn">Register</button>
            <div class="login-link">
                <p>Already have an account? <a href="">Sign In</a> </p>
            </div>

        </form>
    </div>
</body>
</html>
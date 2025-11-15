<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style_login_page.css">

</head>
<body>
    <div class="wrapper">
        <form action="">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="User Name" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-frogot">
                <label for="">
                    <input type="checkbox">Remember Me
                </label>
                <a href="#">Frogot Password</a>
            </div>

            <button type="submit" class="btn">Get Start</button>
            <div class="register-link">
                <p>Don't have an account? <a href="register_page/register_page.php">Register</a> </p>
            </div>

        </form>
    </div>
</body>
</html>
<?php
include 'db_connect.php';
session_start();

// If already logged in → go to correct form
if (isset($_SESSION['age'])) {
    $age = $_SESSION['age'];
    if ($age >= 4 && $age <= 5) header("Location: ../beginner_level/form1.php");
    // if ($age >= 6 && $age <= 8) header("Location: form2.php");
    // if ($age >= 9 && $age <= 13) header("Location: form3.php");
}

// AUTO LOGIN with Remember Me Cookie
if (isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];

    $check = $conn->prepare("SELECT id, username, age FROM users WHERE remember_token = ?");
    $check->bind_param("s", $token);
    $check->execute();
    $user = $check->get_result();

    if ($user->num_rows > 0) {
        $u = $user->fetch_assoc();

        $_SESSION['user_id'] = $u['id'];
        $_SESSION['username'] = $u['username'];
        $_SESSION['age'] = $u['age'];

        // Redirect
        if ($u['age'] >= 4 && $u['age'] <= 5) header("Location: ../");
        //if ($u['age'] >= 6 && $u['age'] <= 8) header("Location: form2.php");
        //if ($u['age'] >= 9 && $u <= 13) header("Location: form3.php");
    }
}
?>

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
                <input type="text" placeholder="User Name" required name="username">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required name="password">
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
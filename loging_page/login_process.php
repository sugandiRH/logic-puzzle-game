<?php
include "../DB_connection";
session_start();

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];
$remember = isset($_POST['remember']) ? 1 : 0;

//check in attempts
$check_attempt = "SELECT attempts, last_attempt FROM login_attempts WHERE username='$username'";
$attempt_result = mysqli_query($conn, $check_attempt);

if (mysqli_num_rows($attempt_result) > 0) {
    $row = mysqli_fetch_assoc($attempt_result);
    $attempts = $row['attempts'];

    // Returns an integer containing the current time as a Unix timestamp
    // w3schools reference: https://www.w3schools.com/php/func_date_time_strtotime.asp
    $last_attempt_time = strtotime($row['last_attempt']);
    $current_time = time();

    // If attempts >= 3 and last attempt was less than 5 mins ago
    if ($attempts >= 3 && ($current_time - $last_attempt_time) < 300) {
        $_SESSION['log_error'] = "Too many attempts. Try again after 5 minutes.";
        header("Location: loginPG.php");
        exit();
    }
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$verifyPW = password_verify($password, $hashedPassword);

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) == 1) { 

    if (password_verify($password, $user['password'])) {
        resetAttempts($conn, $username);

        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['age'] = $user['age'];
        $_SESSION['LAST_ACTIVITY'] = time();
        
        $age = $user['age'];
        if ($age < 6) {
            header("Location: ../gamechoosePG/game(4-5).php");
        } 
        elseif($age >=8 && $age <=12){
            header("Location: ../game8-12/gamePage.php");
        }else
        header("Location: ");
        
    } else {
        
        $_SESSION['log_error'] = "Invalid username or password!";
        recordFailedAttempt($conn, $username);
        header("Location: loginPG.php");
    }
    exit();

} else {
    // Failed login
    $_SESSION['log_error'] = "Invalid username or password!";
    recordFailedAttempt($conn, $username);
    header("Location: loginPG.php");
    exit();
}

function recordFailedAttempt($conn, $username) {
    $attempt_sql = "SELECT * FROM login_attempts WHERE username='$username'";
    $attempt_result = mysqli_query($conn, $attempt_sql);
    // chatgpt suggested code with minor modification
    if (mysqli_num_rows($attempt_result) > 0) {
        $update_attempts = "UPDATE login_attempts SET attempts = attempts + 1, last_attempt = NOW() WHERE username='$username'";
        mysqli_query($conn, $update_attempts);
        return;
    }
    else {
        $insert_attempt = "INSERT INTO login_attempts (username, attempts, last_attempt) VALUES ('$username', 1, NOW())";
        mysqli_query($conn, $insert_attempt);
    }
}

function resetAttempts($conn, $username) {
    $reset_attempts = "DELETE FROM login_attempts WHERE username='$username'";
    mysqli_query($conn, $reset_attempts);
}


?>
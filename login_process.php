<?php
// session_start();
$servername = "localhost";
$username   = "root";  
$password   = "";      
$dbname     = "math_game";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Capture form values
$username = trim($_POST['username']);
$password = $_POST['password'];
$remember = isset($_POST['remember']) ? 1 : 0;

// STEP 1: Check login attempts
$check_attempt = $conn->prepare("SELECT attempts, last_attempt FROM login_attempts WHERE username = ?");
$check_attempt->bind_param("s", $username);
$check_attempt->execute();
$attempt_result = $check_attempt->get_result();

if ($attempt_result->num_rows > 0) {
    $row = $attempt_result->fetch_assoc();
    $attempts = $row['attempts'];
    $last_attempt_time = strtotime($row['last_attempt']);
    $current_time = time();

    // If attempts >= 3 and last attempt was less than 5 mins ago
    if ($attempts >= 3 && ($current_time - $last_attempt_time) < 300) {
        $_SESSION['login_error'] = "Too many attempts. Try again after 5 minutes.";
        header("Location: login.php");
        exit();
    }
}

// STEP 2: Get user
$sql = "SELECT id, username, age, password, remember_token FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$user_result = $stmt->get_result();

if ($user_result->num_rows === 0) {
    recordFailedAttempt($conn, $username); 
    $_SESSION['login_error'] = "Invalid username or password!";
    header("Location: login.php");
    exit();
}

$user = $user_result->fetch_assoc();

// STEP 3: Verify password
if (!password_verify($password, $user['password'])) {
    recordFailedAttempt($conn, $username);
    $_SESSION['login_error'] = "Invalid username or password!";
    header("Location: login.php");
    exit();
}

// STEP 4: SUCCESS – Reset attempt count
resetAttempts($conn, $username);

// STEP 5: Set session
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['age'] = $user['age'];
$_SESSION['LAST_ACTIVITY'] = time();

// STEP 6: Remember Me Feature
if ($remember) {
    $token = bin2hex(random_bytes(16));

    setcookie("remember_token", $token, time() + (86400 * 7), "/", "", false, true);

    $updateToken = $conn->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
    $updateToken->bind_param("si", $token, $user['id']);
    $updateToken->execute();
}

// STEP 7: Redirect based on age
$age = $user['age'];

if ($age >= 4 && $age <= 5) {
    header("Location: form1.php");
} elseif ($age >= 6 && $age <= 8) {
    header("Location: form2.php");
} else {
    header("Location: form3.php");
}

exit();

// FUNCTIONS
function recordFailedAttempt($conn, $username)
{
    $stmt = $conn->prepare("INSERT INTO login_attempts (username, attempts, last_attempt)
        VALUES (?, 1, NOW())
        ON DUPLICATE KEY UPDATE attempts = attempts + 1, last_attempt = NOW()");
    $stmt->bind_param("s", $username);
    $stmt->execute();
}

function resetAttempts($conn, $username)
{
    $stmt = $conn->prepare("DELETE FROM login_attempts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
}
?>

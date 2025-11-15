<?php
session_start();
$servername = "localhost";
$username   = "root";  
$password   = "";      
$dbname     = "math_game";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Get form data
$username = trim($_POST['username']);
$age      = intval($_POST['age']);
$password = $_POST['password'];
$confirm  = $_POST['confirm_password'];

// Validation

if ($age < 4 || $age > 13) {
    $_SESSION['reg_error'] = "Age must be between 4 and 13 years!";
    header("Location: register_page.php");
    exit();
}

if ($password !== $confirm) {
    $_SESSION['reg_error'] = "Passwords do not match!";
    header("Location: register_page.php");
    exit();
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// INSERT query
$sql = "INSERT INTO users (username, age, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $username, $age, $hashedPassword);

if ($stmt->execute()) {
    $_SESSION['reg_success'] = "Registration Successful! Please Login.";
    header("Location: ../login_page.php");
    exit();
} else {
    $_SESSION['reg_error'] = "Username already exists!";
    header("Location: register_page.php");
    exit();
}

$stmt->close();
$conn->close();
?>

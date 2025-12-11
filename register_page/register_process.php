<?php
session_start();
include '../DB_connection'; 

// Get form data
$username = $_POST['username'];
$age      = $_POST['age'];
$password = $_POST['password'];
$confirm  = $_POST['confirm_password'];


// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// INSERT query
$sql = "INSERT INTO users (username, age, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $username, $age, $hashedPassword);

if ($stmt->execute()) {
    $_SESSION['reg_success'] = "Registration Successful! Please Login.";
    header("Location: ../loging_page/loginPG.php");
    exit();
} else {
    $_SESSION['reg_error'] = "Username already exists!";
    header("Location: register_page.php");
    exit();
}

$stmt->close();
$conn->close();
?>

<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  // Check if username already exists
  $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
  $check->bind_param("s", $username);
  $check->execute();
  $check->store_result();

  if ($check->num_rows > 0) {
    // echo "<h3 style='text-align:center; color:red;'>⚠️ Username already exists. Please choose another.</h3>";
    header("Location: ../GUI_html/RegisterPage.html?message=error");
  } else {
    // Hash password using SHA-256
    $hashedPassword = hash('sha256', $password);

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
    // Redirect with success message
    header("Location: RegisterPage.html?message=success");
  } else {
    // Redirect with error message
    header("Location: RegisterPage.html?message=error");
  }

    $stmt->close();
  }

  $check->close();
}

$conn->close();
?>

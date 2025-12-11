<?php
session_start();
include 'DB_connection';

// Get user ID from session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null;
}

// Get game name from POST request
$game_name = $_POST['game'];


// Get current level
$sql = "SELECT level FROM player_level WHERE user_id='$user_id' AND game_name='$game_name'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    

    $updateSQL = "UPDATE player_level 
                  SET wait_time=now() 
                  WHERE user_id='$user_id' AND game_name='$game_name'";

    mysqli_query($conn, $updateSQL);

} else {

    // First time playing → insert level 1
    $insertSQL = "INSERT INTO player_level (user_id, game_name, level,wait_time)
                  VALUES ('$user_id', '$game_name', 1, now())";

    mysqli_query($conn, $insertSQL);
}
?>

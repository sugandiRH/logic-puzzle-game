<?php
session_start();
include '../DB_connection';

header('Content-Type: application/json; charset=utf-8');

// Validate session
if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Not authenticated']);
    exit;
}

$user_id = (int) $_SESSION['user_id'];

// Validate input
$game_name = isset($_POST['game']) ? trim($_POST['game']) : '';
if ($game_name === '') {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing game parameter']);
    exit;
}

// Use prepared statement to clear wait_time (set to 0)
$stmt = $conn->prepare("UPDATE player_level SET wait_time = 0 WHERE user_id = ? AND game_name = ?");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Prepare failed', 'error' => $conn->error]);
    exit;
}

$stmt->bind_param('is', $user_id, $game_name);
if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Execute failed', 'error' => $stmt->error]);
    $stmt->close();
    exit;
}

// Check whether any row was updated
if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'ok', 'updated' => true]);
} else {
    // No matching row or already zero
    echo json_encode(['status' => 'ok', 'updated' => false, 'message' => 'No matching record or already cleared']);
}

$stmt->close();

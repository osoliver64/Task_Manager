<?php
// Start session
session_start();
// Import database functions
require_once("../private/db_functions.php");
// Connect to database
$conn = db_connect();

header('Content-Type: application/json');

if (!isset($_SESSION['userId'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'Task ID not provided.']);
    exit;
}

$sql = "DELETE FROM tasks WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Task successfully deleted.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting the task: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>

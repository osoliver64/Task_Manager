<?php
// Start the session to access session variables
session_start();

// Import database utility functions
require_once("../database/db_functions.php");

// Establish a connection to the database
$conn = db_connect();

// Set the response content type to JSON
header('Content-Type: application/json');

// Check if the user is logged in; if not, return an error response
if (!isset($_SESSION['userId'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit;
}

// Parse the incoming JSON request body
$data = json_decode(file_get_contents('php://input'), true);

// Extract the task ID from the request data
$id = $data['id'] ?? null;

// If no task ID is provided, return an error response
if (!$id) {
    echo json_encode(['success' => false, 'message' => 'Task ID not provided.']);
    exit;
}

// Prepare the SQL statement to delete the task
$sql = "DELETE FROM tasks WHERE id = ?";
$stmt = $conn->prepare($sql);

// Bind the task ID to the SQL query
$stmt->bind_param("i", $id);

// Execute the query and send a success or error response
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Task successfully deleted.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting the task: ' . $conn->error]);
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>

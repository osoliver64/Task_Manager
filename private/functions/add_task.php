<?php
session_start();
require_once("../database/db_functions.php");
$conn = db_connect();

// Set the content type to JSON
header('Content-Type: application/json');

// Verify that the user is authenticated
if (!isset($_SESSION['userId'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Acceso no autorizado.'
    ]);
    exit;
}

// Get the form data
$user_id = $_SESSION['userId'];
$title = trim($_POST['title'] ?? '');
$category = trim($_POST['category'] ?? '');
$priority = trim($_POST['priority'] ?? '');
$due_date = trim($_POST['dueDate'] ?? '');

// Validate the form data
if (empty($title) || empty($category) || empty($priority) || empty($due_date)) {
    echo json_encode([
        'success' => false,
        'message' => 'Todos los campos son obligatorios.'
    ]);
    exit;
}

// Prepare the SQL query to insert the task
$sql = "INSERT INTO tasks (user_id, title, category, priority, due_date, status) 
        VALUES (?, ?, ?, ?, ?, 'pending')";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al preparar la consulta: ' . $conn->error
    ]);
    exit;
}

$stmt->bind_param("issss", $user_id, $title, $category, $priority, $due_date);

// Execute the query to add the task
if ($stmt->execute()) {
    // Get the last inserted task
    $last_id = $conn->insert_id;
    $task_query = "SELECT * FROM tasks WHERE id = ?";
    $task_stmt = $conn->prepare($task_query);

    if ($task_stmt) {
        $task_stmt->bind_param("i", $last_id);
        $task_stmt->execute();
        $result = $task_stmt->get_result();
        $new_task = $result->fetch_assoc();

        // Return the new task data
        echo json_encode([
            'success' => true,
            'task' => $new_task
        ]);

        $task_stmt->close();
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error retrieving the task: ' . $conn->error
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error adding task: ' . $conn->error
    ]);
}

$stmt->close();
$conn->close();
header("Location: ../../pages/index.php")
?>

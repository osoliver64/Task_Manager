<?php
session_start();
include '../private/db_connection.php';

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

// Verificar que el usuario está autenticado
if (!isset($_SESSION['userId'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Acceso no autorizado.'
    ]);
    exit;
}

$user_id = $_SESSION['userId']; // ID del usuario autenticado

// Consulta SQL para obtener las tareas del usuario actual
$sql = "SELECT * FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al preparar la consulta: ' . $conn->error
    ]);
    exit;
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$tasks = [];
while ($task = $result->fetch_assoc()) {
    $tasks[] = $task;
}

echo json_encode([
    'success' => true,
    'tasks' => $tasks
]);

$stmt->close();
$conn->close();
?>

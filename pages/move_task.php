<?php
session_start();
include '../private/db_connection.php';

header('Content-Type: application/json');

if (!isset($_SESSION['userId'])) {
    echo json_encode(['success' => false, 'message' => 'Acceso no autorizado.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;
$status = $data['status'] ?? null;

if (!$id || !$status) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos para mover la tarea.']);
    exit;
}

$sql = "UPDATE tasks SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Tarea movida exitosamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al mover la tarea: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>

<?php
include '../private/db_connection.php';

// Probar consulta
$sql = "SELECT DATABASE() AS db";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Conected to: " . $row['db'];
} else {
    echo "Error, db was not connected.";
}

$conn->close();
?>

<?php
$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "task_manager_table"; 

$conn = new mysqli($host, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>

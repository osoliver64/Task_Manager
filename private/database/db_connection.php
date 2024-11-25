<?php
// Database credentials
$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "task_manager_table"; 

// Connect to database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>


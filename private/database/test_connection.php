<?php
// Include the database connection file
include 'db_connection.php';

// SQL query to get the name of the currently connected database
$sql = "SELECT DATABASE() AS db";
$result = $conn->query($sql); // Execute the query

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    // Output the name of the connected database
    echo "Conected to: " . $row['db'];
} else {
    // Output an error message if the database is not connected
    echo "Error, db was not connected.";
}

// Close the database connection
$conn->close();
?>

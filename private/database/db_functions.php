<?php

// Import database credentials
require_once("db_credentials.php");

    // Function to connect to database and return connection
    function db_connect() {
        // Connect to database with credentials
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        
        // If error when connecting to database exit with error message and number
        if (mysqli_connect_errno()) {
            $msg = "Database connection failed";
            $msg .= " (" . mysqli_connect_errno() . ")";
            exit($msg);
        }
        // Return the database connection
        return $connection;
    }

    // Function to disconnect from database
    function db_disconnect($connection) {
        // If the argument is not null
        if (isset($connection)) {
            // Disconnect connection
            mysqli_close($connection);
        }
    }
?>
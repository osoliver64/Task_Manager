<?php
    // If no session
    if (!isset($_SESSION)) {
        // Start session
        session_start();
    }
    // Delete session
    session_destroy();

    // Redirect ot login page
    header("Location: login.php");

?>
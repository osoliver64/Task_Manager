<?php

    // If session isn't set
    if (!isset($_SESSION)) {
        // Start session
        session_start();
    }
    // If user not logged in
    if (!isset($_SESSION['userId'])) {
        // Redirect user to the log in page
        header("Location: login.php");
    }
    // Message to show when no results for search are found in database
    $noResultsFound = "No results found.";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks Search Results</title>
    <link rel="stylesheet" href="../styles/style.css" >
    <script src="../scripts/script.js" defer></script>
    <script src="../scripts/sidebar_script.js" defer></script>
</head>
<body class="taskbarOpen innerSiteBody">  
    <header class="header">
        <!-- Main title -->
        <div class="title-container">
            <h1>My Task Manager</h1>
        </div>
        <!-- Company logo -->
        <div class="logo-container">
            <img src="../images/logo.svg" alt="Logo" class="logo">
        </div>
    </header>
    <!-- Import the side bar menu -->
    <?php include "side_bar.php"; ?>
<main>
    <div class="board">
        <div class="column" id="pending">
            <h1 class="subHeading">Search Results:</h1>
                <div class="track-list">
                    <?php
                    // If search result is not empty
                    if (!empty($_SESSION["searchResult"])) {
                        // Display each task in search result
                        foreach ($_SESSION["searchResult"] as $task) {
                            ?>
                            <!-- Task -->
                            <div class="task <?= $task['priority'] ?>">
                                <!-- Task title, category and due date -->
                                <h3><?= htmlspecialchars($task['title']) . " | " . htmlspecialchars($task['category']) . " | Due to: " . htmlspecialchars($task['due_date']) ?></h3>
                                <!-- Button to delete the task -->
                                <button onclick="deleteTask('<?= $task['id'] ?>')">Delete</button>
                            </div>
                            <?php
                        }
                    // If search result is empty
                    } else {
                        // Display no results found message
                        echo "<h3>" . htmlspecialchars($noResultsFound) . "</h3>";
                    }
                    ?>
                </div>
        </div>
    </div>

</main>
</body>
</html>
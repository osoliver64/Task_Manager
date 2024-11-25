<?php
    
    require_once("../private/database/db_functions.php");
    // If no session
    if (!isset($_SESSION)) {
        // Start session
        session_start();
    }
    // If user isn't logged in redirect to log in page
    if (!isset($_SESSION["userId"])) {
        header("Location: login.php");
    }
    // Connect to database
    $db = db_connect();
    // Message for when no tasks found
    $noResultsMsg = "No medium priority tasks found.";
    
    // Store user id
    $userId = $_SESSION["userId"];

    // Query to select user's medium priority tasks
    $sqlSearchQuery = "SELECT * FROM tasks WHERE user_id = $userId AND priority = 'medium'";
    // Execute query
    $mediumTaskResultSet = mysqli_query($db, $sqlSearchQuery);

    // If sql query returned any rows
    if (mysqli_num_rows($mediumTaskResultSet) > 0){
        
        // Array to to store associative arrays
        $mediumTasks = [];
        // Fill array with query results as associative arrays
        while ($row = mysqli_fetch_assoc($mediumTaskResultSet)) {
            $mediumTasks[] = $row;
        }
    }
    // Disconnect from database
    db_disconnect($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medium Prioity Tasks</title>
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
            <!-- Subheading -->
            <h1 class="subHeading">Medium Priority Tasks: </h1>
                <div class="track-list">
                    <?php
                    // If user has any medium priority tasks
                    if (!empty($mediumTasks)) {
                        // Display each medium priority task
                        foreach ($mediumTasks as $task) {
                            ?>
                            <!-- Task -->
                            <div class="task <?= $task['priority'] ?>">
                                <!-- Task title, category and due date -->
                                <h3><?= htmlspecialchars($task['title']) . " | " . htmlspecialchars($task['category']) . " | Due to: " . htmlspecialchars($task['due_date']) ?></h3>
                                <!-- Button to delete task -->
                                <button onclick="deleteTask('<?= $task['id'] ?>')">Delete</button>
                            </div>
                            <?php
                    }}
                    // If user doesn't have any medium priority tasks
                    else {
                    // Display no results message
                    echo "<h3>" . htmlspecialchars($noResultsMsg) . "</h3>";
                    }
                    ?>
                </div>
        </div>
    </div>

    </main>
</body>
</html>
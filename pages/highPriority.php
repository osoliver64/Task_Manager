<?php
    
    require_once("../private/db_functions.php");
    // If no session, start session
    if (!isset($_SESSION)) {
        session_start();
    }
    // If no valid user session redirect to login page
    if (!isset($_SESSION["userId"])) {
        header("Location: login.php");
    }
    // Connect to database
    $db = db_connect();
    // Message for when no tasks found
    $noResultsMsg = "No high priority tasks found.";
    
    $userId = $_SESSION["userId"];

    $sqlSearchQuery = "SELECT * FROM tasks WHERE user_id = $userId AND priority = 'high'";
    $highTaskResultSet = mysqli_query($db, $sqlSearchQuery);

    if (mysqli_num_rows($highTaskResultSet) > 0){
        
        $highTasks = [];
        while ($row = mysqli_fetch_assoc($highTaskResultSet)) {
            $highTasks[] = $row;
        }
    }
    db_disconnect($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High Prioity Tasks</title>
    <link rel="stylesheet" href="../styles/style.css" >
    <script src="../scripts/script.js" defer></script>
    <script src="../scripts/sidebar_script.js" defer></script>
</head>
<body class="taskbarOpen innerSiteBody">
    <header class="header">
        <div class="title-container">
            <h1>My Task Manager</h1>
        </div>
        <div class="logo-container">
            <img src="../images/logo.svg" alt="Logo" class="logo">
        </div>
    </header>
    <?php include "side_bar.php"; ?>
    <main>
        
    <div class="board">
        <div class="column" id="pending">
            <h1 class="subHeading">High Priority Tasks: </h1>
                <div class="track-list">
                    <?php
                    if (!empty($highTasks)) {
                        foreach ($highTasks as $task) {
                            ?>
                            <div class="task <?= $task['priority'] ?>">
                                <h3><?= htmlspecialchars($task['title']) . " | " . htmlspecialchars($task['category']) . " | Due to: " . htmlspecialchars($task['due_date']) ?></h3>
                                <button onclick="deleteTask('<?= $task['id'] ?>')">Delete</button>
                            </div>
                            <?php
                    }}
                    else {
                    echo "<h3>" . htmlspecialchars($noResultsMsg) . "</h3>";
                    }
                    ?>
                </div>
        </div>
    </div>

    </main>
</body>
</html>
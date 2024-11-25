<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['userId'])) {
        header("Location: login.php");
    }
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
            <h1 class="subHeading">Search Results:</h1>
                <div class="track-list">
                    <?php
                    if (!empty($_SESSION["searchResult"])) {
                        foreach ($_SESSION["searchResult"] as $task) {
                            ?>
                            <div class="task <?= $task['priority'] ?>">
                            <h3><?= htmlspecialchars($task['title']) . " | " . htmlspecialchars($task['category']) . " | Due to: " . htmlspecialchars($task['due_date']) ?></h3>
                                <button onclick="deleteTask('<?= $task['id'] ?>')">Delete</button>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<h3>" . htmlspecialchars($noResultsFound) . "</h3>";
                    }
                    ?>
                </div>
        </div>
    </div>

</main>
</body>
</html>
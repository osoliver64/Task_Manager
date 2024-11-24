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
    <?php include "side_bar.php"; ?>
<main>
    <h2 class="subHeading">Search Results:</h2>
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

</main>
</body>
</html>
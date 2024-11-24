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
    <h2>Search Results:</h2>
        <?php
        if (!empty($_SESSION["searchResult"])) {
            foreach ($_SESSION["searchResult"] as $task) {
                ?>
                <div class="task <?= $task['priority'] ?>">
                    <h3><?= htmlspecialchars($task['priority']) ?></h3>
                    <p><?= htmlspecialchars($task['title']) ?></p>
                    <p>Due to: <?= htmlspecialchars($task['category']) ?></p>
                    <p>Priority: <?= ucfirst(htmlspecialchars($task['priority'])) ?></p>
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
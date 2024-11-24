<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    $noResultsFound = "No task matching this name found.";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/style.css" >
</head>
<body>
<main>

    <?php
    // echo $_SESSION['searchResult'];

    // for each ($row = $_SESSION["searchResult"]) {
    //     echo "<p>$row</p>";
    // }
    // POSSIBLY TAKE OUT ISSET (MAY BE REDUNDANT)
    
    if (!empty($_SESSION["searchResult"])) { // Check if searchResult is not empty
        foreach ($_SESSION["searchResult"] as $task) { 
            ?>
            <div class="task <?= $task['priority'] ?>">
                <h3><?= htmlspecialchars($task['priority']) ?></h3>
                <p><?= htmlspecialchars($task['title']) ?></p>
                <p>Due to: <?= htmlspecialchars($task['category']) ?></p>
                <p>Priority: <?= ucfirst(htmlspecialchars($task['priority'])) ?></p>
                <button onclick="deleteTask('<?= htmlspecialchars($task['id']) ?>')">Delete</button>
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
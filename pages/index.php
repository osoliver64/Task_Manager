<?php 
    session_start();

    // If user not logged in
    if (!isset($_SESSION['userId'])) {
        // Redirect to login page
        header('location: login.php');
        exit();
    }

    // Import database functions
    require_once("../private/db_functions.php");
    // Connect to database
    $db = db_connect();

    
    // Function to load tasks when the page is initialized
    function fetchTasks($userId, $db) {
        $stmt = $db->prepare("SELECT id, title, category, priority, due_date, status FROM tasks WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        $stmt->close();
        return $tasks;
    }
    // Fetch the tasks of the current user
    $userId = $_SESSION['userId'];
    $tasks = fetchTasks($userId, $db);

    db_disconnect($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <!-- Link to main stylesheet -->
    <link rel="stylesheet" href="../styles/style.css">
    <!-- Link to JavaScript files for main functionality and sidebar -->
    <script src="../scripts/script.js" defer></script>
    <script src="../scripts/sidebar_script.js" defer></script>
</head>
<body id="indexBody" class="taskbarOpen innerSiteBody">
    <!-- Header section with a button to add a new task -->
    <header class="header">
        <div class="title-container">
            <h1>My Task Manager</h1>
        </div>
        <div class="logo-container">
            <img src="../images/logo.svg" alt="Logo" class="logo">
        </div>
    </header>

    <div>
    <?php include "search.php" ?>
    <!-- Sidebar section with links to different task statuses -->
    <?php include "side_bar.php"; ?>
    </div>
    <!-- Main content section with columns for each task status -->
    <main>
        <div class="headings">
            <h1>Your tasks</h1>
        </div>
        <div>
        <button id="addNewTaskButton" onclick="openTaskModal()">New Task</button>
        </div>
        <div class="board">
            <!-- Column for pending tasks with sorting options -->
            <div class="column" id="pending">
                <h2>Pending Tasks 
                </h2>
                <div class="task-list">
                    <?php foreach ($tasks as $task): ?>
                        <?php if ($task['status'] === 'pending'): ?>
                            <div class="task <?= htmlspecialchars($task['priority']) ?>">
                            <h3><?= htmlspecialchars($task['title']) . " | " . htmlspecialchars($task['category']) . " | Due to: " . htmlspecialchars($task['due_date']) ?></h3>
                                <button onclick="deleteTask('<?= $task['id'] ?>')">Delete</button>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal for adding a new task -->
    <div class="modal" id="taskModal">
        <div class="modal-content">
            <span class="close" onclick="closeTaskModal()">&times;</span>
            <h2>New Task</h2>
            <form id="taskForm" action="add_task.php" method="post">
                <!-- Input fields for task details -->
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>

                <label for="category">Category:</label>
                <input type="text" name="category" id="category" required>

                <label for="priority">Priority:</label>
                <select name="priority" id="priority" required>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>

                <label for="dueDate">Due to:</label>
                <input type="date" name="dueDate" id="dueDate" required>
                
                <!-- Button to save the new task -->
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
    
    <?php include "footer.php" ?>
</body>
</html>

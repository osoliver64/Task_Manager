<?php 
    session_start();

    // If user not logged in
    if (!isset($_SESSION['userId'])) {
        // Redirect to login page
        header('location: login.php');
        exit();
    }

    // Import database functions
    require_once("../private/database/db_functions.php");
    // Connect to database
    $db = db_connect();

    // Function to load tasks when the page is initialized
    function fetchTasks($userId, $db) {
        // Prepare SQL query to fetch tasks for the given user ID
        $stmt = $db->prepare("SELECT id, title, category, priority, due_date, status FROM tasks WHERE user_id = ?");
        $stmt->bind_param("i", $userId); // Bind user ID as an integer parameter
        $stmt->execute(); // Execute the query
        $result = $stmt->get_result(); // Fetch the results
        $tasks = []; // Initialize an empty array to store tasks
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row; // Add each row to the tasks array
        }
        $stmt->close(); // Close the statement
        return $tasks; // Return the list of tasks
    }
    // Fetch the tasks of the current user
    $userId = $_SESSION['userId']; // Get the user ID from the session
    $tasks = fetchTasks($userId, $db); // Retrieve the tasks for the logged-in user

    db_disconnect($db); // Disconnect from the database
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
    <!-- Include the search bar functionality -->
    <?php include "../pages/search.php" ?>
    <!-- Sidebar section with links to different task statuses -->
    <?php include "../pages/side_bar.php"; ?>
    </div>
    <!-- Main content section with columns for each task status -->
    <main>
        <div class="headings">
            <h1>Your tasks</h1>
        </div>
        <div>
        <!-- Button to trigger the modal for adding a new task -->
        <button id="addNewTaskButton" onclick="openTaskModal()">New Task</button>
        </div>
        <div class="board">
            <!-- Column for pending tasks with sorting options -->
            <div class="column" id="pending">
                <h2>Pending Tasks 
                </h2>
                <div class="task-list">
                    <!-- Loop through the tasks and display only pending tasks -->
                    <?php foreach ($tasks as $task): ?>
                        <?php if ($task['status'] === 'pending'): ?>
                            <div class="task <?= htmlspecialchars($task['priority']) ?>">
                                <!-- Display task details -->
                                <h3><?= htmlspecialchars($task['title']) . " | " . htmlspecialchars($task['category']) . " | Due to: " . htmlspecialchars($task['due_date']) ?></h3>
                                <!-- Button to delete the task -->
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
            <form id="taskForm" action="../private/functions/add_task.php" method="post">
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
</body>
</html>

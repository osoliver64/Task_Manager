<!DOCTYPE html>
<?php 
    session_start();

    // Redirige al usuario si no ha iniciado sesión
    if (!isset($_SESSION['userId'])) {
        header('location: login.php');
        exit();
    }

    require_once("../private/db_functions.php");
    $db = db_connect();

    // Función para cargar las tareas al iniciar la página
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

    // Obtener las tareas del usuario actual
    $userId = $_SESSION['userId'];
    $tasks = fetchTasks($userId, $db);

    db_disconnect($db);
?>


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
<body id="indexBody" class="taskbarOpen">
    <!-- Header section with a button to add a new task -->
    <header>
        <button id="addNewTaskButton" onclick="openTaskModal()">New Task</button>
    </header>
    
    <!-- Sidebar section with links to different task statuses -->
    <?php include "side_bar.php"; ?>

    <!-- Main content section with columns for each task status -->
    <main>
        <div class="headings">
            <h1>Your tasks</h1>
        </div>
        <div class="board">
            <!-- Column for pending tasks with sorting options -->
            <div class="column" id="pending">
                <h2>Pending</h2>
                
                
                <!-- Sort by selector -->
                <select onchange="sortTasks('pending', this.value)">
                        <option value="title">Title</option>
                        <option value="priority">Priority</option>
                        <option value="dueDate">Due Date</option>
                </select>



                <div class="sort-container">
                    <label for="sortBy">Sort by:</label>
                    <select id="sortBy" onchange="sortTasks()">
                        <option value="dueDate">Due Date</option>
                        <option value="priority">Priority</option>
                        <option value="category">Title</option>
                    </select>
                </div>
                
                <div class="task-list">
                    <?php foreach ($tasks as $task): ?>
                        <?php if ($task['status'] === 'pending'): ?>
                            <div class="task <?= htmlspecialchars($task['priority']) ?>">
                                <h3><?= htmlspecialchars($task['title']) ?></h3>
                                <p>Priority: <?= ucfirst(htmlspecialchars($task['priority'])) ?></p>
                                <p><?= htmlspecialchars($task['category']) ?></p>
                                <p>Due to: <?= htmlspecialchars($task['due_date']) ?></p>
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

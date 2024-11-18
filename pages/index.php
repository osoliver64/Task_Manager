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
                <h2>Pending
                    <select onchange="sortTasks('pending', this.value)">
                        <option value="title">Title</option>
                        <option value="priority">Priority</option>
                        <option value="dueDate">Due Date</option>
                    </select>
                </h2>
                <div class="task-list"></div>
            </div>
            
            <!-- Column for in-progress tasks with sorting options -->
            <div class="column" id="in-progress">
                <h2>In Progress 
                    <select onchange="sortTasks('in-progress', this.value)">
                        <option value="title">Title</option>
                        <option value="priority">Priority</option>
                        <option value="dueDate">Due Date</option>
                    </select>
                </h2>
                <div class="task-list"></div>
            </div>
            
            <!-- Column for completed tasks with sorting options -->
            <div class="column" id="completed">
                <h2>Completed
                    <select onchange="sortTasks('completed', this.value)">
                        <option value="title">Title</option>
                        <option value="priority">Priority</option>
                        <option value="dueDate">Due Date</option>
                    </select>
                </h2>
                <div class="task-list"></div>
            </div>
        </div>
    </main>

    <!-- Modal for adding a new task -->
    <div class="modal" id="taskModal">
        <div class="modal-content">
            <span class="close" onclick="closeTaskModal()">&times;</span>
            <h2>New Task</h2>
            <form id="taskForm">
                <!-- Input fields for task details -->
                <label for="title">Title:</label>
                <input type="text" id="title" required>

                <label for="category">Category:</label>
                <input type="text" id="category" required>

                <label for="priority">Priority:</label>
                <select id="priority" required>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>

                <label for="dueDate">Due to:</label>
                <input type="date" id="dueDate" required>
                
                <!-- Button to save the new task -->
                <button type="button" onclick="saveTask()">Save</button>
            </form>
        </div>
    </div>
    
    <?php include "footer.php" ?>
</body>
</html>

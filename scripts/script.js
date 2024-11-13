let tasks = []; // Array to store all tasks with properties like title, category, priority, due date, and status

// Function to open the task modal for adding a new task
function openTaskModal() {
    document.getElementById("taskModal").style.display = "flex";
}

// Function to close the task modal and reset its input fields
function closeTaskModal() {
    document.getElementById("taskModal").style.display = "none";
    document.getElementById("taskForm").reset();
}

// Function to save a new task to the tasks array
function saveTask() {
    const title = document.getElementById("title").value;
    const category = document.getElementById("category").value;
    const priority = document.getElementById("priority").value;
    const dueDate = document.getElementById("dueDate").value;

    // Creating a new task object with a unique ID
    const task = {
        id: Date.now(),
        title,
        category,
        priority,
        dueDate,
        status: "pending" // Default status for new tasks
    };

    tasks.push(task); // Add task to the array
    renderTasks(); // Update the task display
    closeTaskModal(); // Close the modal after saving
}

// Function to render tasks in their respective columns based on their status
function renderTasks() {
    // Clear current task lists
    document.querySelectorAll(".task-list").forEach(list => list.innerHTML = "");

    // Iterate over tasks and add them to the appropriate column
    tasks.forEach(task => {
        const taskElement = document.createElement("div");
        taskElement.classList.add("task", task.priority); // Set task class based on priority
        taskElement.innerHTML = `
            <h3>${task.title}</h3>
            <p>${task.category}</p>
            <p>Due to: ${task.dueDate}</p>
            <p>Priority: ${task.priority.charAt(0).toUpperCase() + task.priority.slice(1)}</p>
            ${task.status === "pending" ? `<button onclick="moveTask('${task.id}', 'in-progress')">Move to In Progress</button>` : ""}
            ${task.status === "in-progress" ? `<button onclick="moveTask('${task.id}', 'completed')">Move to Completed</button>` : ""}
            <button onclick="deleteTask('${task.id}')">Delete</button>
        `;
        document.getElementById(task.status).querySelector(".task-list").appendChild(taskElement);
    });
}

// Function to move a task to a different status
function moveTask(id, status) {
    const task = tasks.find(t => t.id == id); // Find task by ID
    task.status = status; // Update task status
    renderTasks(); // Re-render tasks
}

// Function to delete a task by its ID
function deleteTask(id) {
    tasks = tasks.filter(t => t.id != id); // Remove task from the array
    renderTasks(); // Re-render tasks
}

// Function to sort tasks within a specific status column based on selected criteria
function sortTasks(status, criteria) {
    // Sort tasks that match the selected status
    tasks = tasks.filter(task => task.status === status).sort((a, b) => {
        if (criteria === "title" || criteria === "category") {
            return a[criteria].localeCompare(b[criteria]);
        } else if (criteria === "priority") {
            const priorityOrder = { "high": 1, "medium": 2, "low": 3 };
            return priorityOrder[a.priority] - priorityOrder[b.priority];
        } else if (criteria === "dueDate") {
            return new Date(a.dueDate) - new Date(b.dueDate);
        }
    }).concat(tasks.filter(task => task.status !== status)); // Keep non-matching tasks in place

    renderTasks(); // Update the task display
}

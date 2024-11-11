let tasks = []; //will save all tasks from user, saving data such as title, category, priority, dueDate and status

function openTaskModal() {
    document.getElementById("taskModal").style.display = "flex"; //we make the display flex to make it visible
}

function closeTaskModal() {
    document.getElementById("taskModal").style.display = "none"; //closes the taskModal
    document.getElementById("taskForm").reset();                 //resets the values of taskmodal
}

function saveTask() {
    const title = document.getElementById("title").value;
    const category = document.getElementById("category").value;
    const priority = document.getElementById("priority").value;
    const dueDate = document.getElementById("dueDate").value;

    const task = {
        id: Date.now(),
        title,
        category,
        priority,
        dueDate,
        status: "pending"
    };

    tasks.push(task);
    renderTasks(); 
    closeTaskModal();
}

function renderTasks() {
    document.querySelectorAll(".task-list").forEach(list => list.innerHTML = "");

    tasks.forEach(task => {
        const taskElement = document.createElement("div");
        taskElement.classList.add("task", task.priority);
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

function moveTask(id, status) {
    const task = tasks.find(t => t.id == id);
    task.status = status;
    renderTasks();
}

function deleteTask(id) {
    tasks = tasks.filter(t => t.id != id);
    renderTasks();
}


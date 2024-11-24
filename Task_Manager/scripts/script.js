let tasks = []; // Array to store all tasks

// Function to open the task modal
function openTaskModal() {
    document.getElementById("taskModal").style.display = "flex";
}

// Function to close the task modal
function closeTaskModal() {
    document.getElementById("taskModal").style.display = "none";
    document.getElementById("taskForm").reset();
}

// Function to save a new task
function saveTask() {
    const title = document.getElementById("title").value;
    const category = document.getElementById("category").value;
    const priority = document.getElementById("priority").value;
    const dueDate = document.getElementById("dueDate").value;

    // Validación de campos
    if (!title || !category || !priority || !dueDate) {
        alert("Todos los campos son obligatorios.");
        return;
    }

    // Crear datos para enviar al servidor
    const formData = new FormData();
    formData.append("title", title);
    formData.append("category", category);
    formData.append("priority", priority);
    formData.append("dueDate", dueDate);

    // Usar fetch para enviar datos sin redireccionar
    fetch("./pages/add_task.php", {
        method: "POST",
        body: formData,
    })
        .then(response => response.json()) // Convertir respuesta en JSON
        .then(data => {
            if (data.success) {
                // Tarea agregada exitosamente
                closeTaskModal(); // Cerrar modal
                fetchTasks(); // Actualizar las tareas desde la base de datos
            } else {
                // Mostrar error
                alert("Error al agregar la tarea: " + data.error);
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
}


// Function to fetch tasks
function fetchTasks() {
    fetch("./pages/fetch_tasks.php")
        .then(response => response.json())
        .then(data => {
            tasks = data;
            renderTasks();
        })
        .catch(error => console.error("Error fetching tasks:", error));
}

// Function to render tasks
function renderTasks() {
    document.querySelectorAll(".task-list").forEach(list => (list.innerHTML = ""));
    tasks.forEach(task => {
        const taskElement = document.createElement("div");
        taskElement.classList.add("task", task.priority);
        taskElement.innerHTML = `
            <h3>${task.title}</h3>
            <p>${task.category}</p>
            <p>Due to: ${task.due_date}</p>
            <p>Priority: ${task.priority.charAt(0).toUpperCase() + task.priority.slice(1)}</p>
            <button onclick="deleteTask(${task.id})">Delete</button>
        `;
        document.getElementById(task.status).querySelector(".task-list").appendChild(taskElement);
    });
}

// Function to delete a task
function deleteTask(id) {
    fetch("../pages/delete_task.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchTasks(); // Refresh tasks
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    location.reload();
}




// Function to sort tasks based on selected criteria
function sortTasks(status, criteria) {
    // Sort tasks that match the selected status
    tasks = tasks.filter(task => task.status === status).sort((a, b) => {
        if (criteria === "title") {
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





// Fetch tasks on page load
document.addEventListener("DOMContentLoaded", fetchTasks);

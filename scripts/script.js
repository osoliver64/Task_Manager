let tasks = []; // Array to store all tasks

// Function to open the task modal
function openTaskModal() {
    // Display the modal by changing its style
    document.getElementById("taskModal").style.display = "flex";
}

// Function to close the task modal
function closeTaskModal() {
    // Hide the modal by changing its style
    document.getElementById("taskModal").style.display = "none";
    // Reset the form inside the modal to clear all input fields
    document.getElementById("taskForm").reset();
}

// Function to save a new task
function saveTask() {
    // Retrieve input values from the form fields
    const title = document.getElementById("title").value;
    const category = document.getElementById("category").value;
    const priority = document.getElementById("priority").value;
    const dueDate = document.getElementById("dueDate").value;

    // Validate that all fields are filled
    if (!title || !category || !priority || !dueDate) {
        alert("Todos los campos son obligatorios."); // Alert the user if any field is missing
        return;
    }

    // Create a FormData object to send the task data to the server
    const formData = new FormData();
    formData.append("title", title); // Add the title to the FormData 
    formData.append("category", category); // Add the category to the FormData 
    formData.append("priority", priority); // Add the priority to the FormData 
    formData.append("dueDate", dueDate); // Add the due date to the FormData

    // Use fetch to send a POST request with the task data
    fetch("../pages/add_task.php", {
        method: "POST", // HTTP method for sending data
        body: formData, // Attach the FormData as the body of the request
    })
        .then(response => response.json()) // Convert the server's response to JSON format
        .then(data => {
            if (data.success) {
                // If the task was added successfully
                closeTaskModal(); // Close the modal
                fetchTasks(); // Fetch the updated list of tasks
            } else {
                // Show an error message if the task could not be added
                alert("Error al agregar la tarea: " + data.error);
            }
        })
        .catch(error => {
            // Log any errors that occur during the fetch process
            console.error("Error:", error);
            console.error(error.message);
        });
}

// Function to delete a task
function deleteTask(id) {
    // Use fetch to send a POST request to delete a task
    fetch("../private/functions/delete_task.php", {
        method: "POST", // HTTP method for sending data
        headers: { "Content-Type": "application/json" }, // Set the content type to JSON
        body: JSON.stringify({ id }), // Attach the task ID as a JSON object
    })
        .then(response => response.json()) // Convert the server's response to JSON format
        .then(data => {
            if (data.success) {
                // If the task was deleted successfully
                fetchTasks(); // Fetch the updated list of tasks
            } else {
                // Show an error message if the task could not be deleted
                alert(data.message);
            }
        })
        .catch(error => console.error("Error:", error)); // Log any errors that occur during the fetch process

    location.reload(); // Reload the page to reflect the changes (optional, can be replaced with UI updates)
}

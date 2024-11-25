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
         // Alert the user if any field is missing
        alert("All fields are required");
        return;
    }

    // Create a FormData object to send the task data to the server
    const formData = new FormData();
    formData.append("title", title);
    formData.append("category", category); 
    formData.append("priority", priority); 
    formData.append("dueDate", dueDate); 

    // Use fetch to send a POST request with the task data
    fetch("../pages/add_task.php", {
        method: "POST",
         // Attach the FormData as the body of the request
        body: formData,
    })
        .then(response => response.json()) // Convert the server's response to JSON format
        .then(data => {
            // If the task was added successfully
            if (data.success) {
                // Close the modal
                closeTaskModal(); 
                // Fetch the updated list of tasks
                fetchTasks(); 
            } else {
                // Show an error message if the task could not be added
                alert("Error adding the task: " + data.error);
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
         // Set the content type to JSON
        headers: { "Content-Type": "application/json" },
         // Attach the task ID as a JSON object
        body: JSON.stringify({ id }),
    })
        // Convert the server's response to JSON format
        .then(response => response.json()) 
        .then(data => {
            if (data.success) {
                // If the task was deleted successfully
                fetchTasks(); // Fetch the updated list of tasks
            } else {
                // Show an error message if the task could not be deleted
                alert(data.message);
            }
        })
        // Log any errors that occur during the fetch process
        .catch(error => console.error("Error:", error));

    location.reload(); // Reload the page to reflect the changes
}

<?php
    
    // Import database functions
    require_once(__DIR__ . "/../private/database/db_functions.php");

    // If session isn't set
    if (!isset($_SESSION)) {
        // Start session
        session_start();
    }

    // If request method is post
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        // Connect to database
        $db = db_connect();

        // If search bar data is sent by post and user is logged in
        if (isset($_POST["searchBar"]) && isset($_SESSION["userId"])){
            // Erase and previous search from the session variable
            unset($_SESSION["searchResult"]);
            
            // Select and store search input data and user's id
            $searchInput = $_POST["searchBar"];
            $userId = $_SESSION["userId"];

            // Query for search which searched database for any tasks with the user's id and a title or category 
            // containing the user's input
            $sqlSearchQuery = "SELECT * FROM tasks WHERE user_id = $userId AND (title LIKE '%" . $searchInput . "%' OR category LIKE '%" . $searchInput . "%')";
            // Execute the query
            $searchResultSet = mysqli_query($db, $sqlSearchQuery);

            // If search has results
            if (mysqli_num_rows($searchResultSet) > 0){
                
                // Variable to store associative array of results in
                $searchResult = [];
                // Store results as an associative array
                while ($row = mysqli_fetch_assoc($searchResultSet)) {
                    $searchResult[] = $row;
                }
                // Point a session variable to the associative array
                $_SESSION["searchResult"] = $searchResult;
            }
        }
        // Redirect to search results page
        header("Location: search_results.php");
        // Disconnect from database
        db_disconnect($db);
    }
?>


<form action="search.php" method="POST">
    <input type="text" name="searchBar" id="searchBar" placeholder="Search">
    <button type="submit" name="search" id="searchButton">Search</button>
</form>
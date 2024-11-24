<?php
    
    require_once("../private/db_functions.php");
    if (!isset($_SESSION)) {
        session_start();
    }

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $db = db_connect();

        if (isset($_POST["searchBar"]) && isset($_SESSION["userId"])){

            unset($_SESSION["searchResult"]);
            
            $searchInput = $_POST["searchBar"];
            $userId = $_SESSION["userId"];

            $sqlSearchQuery = "SELECT * FROM tasks WHERE user_id = $userId AND title LIKE '%" . $searchInput . "%'";
            $searchResultSet = mysqli_query($db, $sqlSearchQuery);

            if (mysqli_num_rows($searchResultSet) > 0){
                
                $searchResult = [];
                while ($row = mysqli_fetch_assoc($searchResultSet)) {
                    $searchResult[] = $row;
                }
                $_SESSION["searchResult"] = $searchResult;
            }
        }
        header("Location: search_results.php");
        db_disconnect($db);
    }
?>


<form action="search.php" method="POST">
    <input type="text" name="searchBar" id="searchBar" placeholder="Search">
    <button type="submit" name="search" id="searchButton">Search</button>
</form>
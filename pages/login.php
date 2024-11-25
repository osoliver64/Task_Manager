<!DOCTYPE html>
<?php
    // Import database funtions
    require_once("../private/database/db_functions.php");
    // Start session
    session_start();
    // Connect to database
    $db = db_connect();
    // Login error message for incorrect username or password
    $loginErrorMsg = "Incorrect username or password";
    // Login error variable, will contain error message if error and empty if no error
    $loginError = "";
    // Boolean to track if user credentials match a valid user
    $validUser = true;
    // If method is post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // If username and password inputs have been submitted
        if (isset($_POST['loginUsername']) && isset($_POST["loginPassword"])) {
            // Store username and password values in variables
            $username = $_POST['loginUsername'];
            $password = $_POST['loginPassword'];

            // Query to get user's ID if the username and password match a user
            $loginQuery = "SELECT user_id FROM user ";
            $loginQuery .= "WHERE username = '$username' AND password = '$password'";

            // Run query and return result set
            $loginResultSet = mysqli_query($db, $loginQuery);
            // Access number of rows returned, should be 0 or 1
            $rowCount = mysqli_num_rows($loginResultSet);

            // If number of rows is not zero (ie. if user exists in database)
            if ($rowCount !== 0) {
                // Convert result set to associative array
                $loginResult = mysqli_fetch_assoc($loginResultSet);
                // Grab user ID from result set
                $userId = $loginResult["user_id"];

                // Store user id in session variable
                $_SESSION["userId"] = $userId;
                // Redirect to website main page
                header("location: index.php");
            }
            // if no users in database match username and password
            else {
                $validUser = false;
                $loginError = $loginErrorMsg;
            }
        }
        // If username or password have not been entered
        else {
            $validUser = false;
        }
    }
?>

<script>
    // Return if the user is valid (if exists in database)
    function isUserValid() {
        return $validUser;
    }
</script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/form_styles.css">
    <script src="../scripts/loginValidation.js" defer></script>
    <title>Task Manager: Log In</title>
</head>
<body>
    <!-- Include header for when logged out -->
    <?php include "loggedOutHeader.php" ?>
    <main>
        <div class="formContainer">
        <h1>Log In</h1>
        <form action="login.php" method="post" onsubmit="return validateLogin() && isUserValid();">

            <div class="textInputContainer">
                <!-- Username input label -->
                <label for="loginUsername">User Name</label>
                <!-- Username input field -->
                <input type="text" name="loginUsername" id="loginUsername" placeholder="User name" value="<?php
                // If user has already tried to submit, fill value with previously entered username
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo htmlspecialchars($username);
                }
                else {
                    echo '';
                }
                ?>">
            </div>

            <div class="textInputContainer">
                <!-- Password input label -->
                <label for="loginPassword">Password</label>
                <!-- Password input field -->
                <input type="password" name="loginPassword" id="loginPassword" placeholder="Password">
            </div>
                <!-- Error message for incorrect username or password -->
            <?= "<span class='warning' id='loginErrorMsg'>$loginError</span>" ?>
                <!-- Link to registration page (registration.php) -->
            <p><a href="registration.php" class="signInLink">Don't have an account? Click here to sign-up.</a></p>
            
            <div class="formButtonsContainer">
                <!-- Submit button to log in -->
                <button id="loginSubmit" class="submit" type="submit">Log-In</button>
            </div>

        </form>

        </div>
    </main>
</body>
</html>
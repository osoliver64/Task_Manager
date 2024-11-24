<!DOCTYPE html>
<?php
    // Import database functions
    require_once("../private/db_functions.php");
    // Connect to database
    $db = db_connect();

    // Error message if user bypasses JS validation
    $registrationErrorMsg = "Error. Please enter fill in all form fields.";
    // Error message for when username is taken by another user
    $usernameErrorMsg = "Username taken. Please try another.";
    // Variable which will be empty if no error, and have value of error message if error
    $usernameError = "";
    // Boolean to track if username entered is taken by another user or not
    $usernameNotTaken = true;

    // If form is submitted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // If all fields are non-emty
        if (!isset($_POST["reset"]) &&
        (isset($_POST["firstName"]) &&
        isset($_POST["lastName"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"]) &&
        isset($_POST["retype"]) &&
        isset($_POST["submit"]))) {
            // Save form input values in variables after trimming
            $firstName = trim($_POST["firstName"]);
            $lastName = trim($_POST["lastName"]);
            $email = trim($_POST["email"]);
            $username = trim($_POST["username"]);
            $password = $_POST["password"];
            // Pull matching usernames from database if any
            $sqlTakenUsernames = "SELECT username FROM user WHERE username = '$username'";
            $takenUsernames = mysqli_query($db, $sqlTakenUsernames);
            // If username is not taken already
            if (mysqli_num_rows($takenUsernames) === 0) {
                // Query to insert new user information to database
                $sql = "INSERT INTO user (firstName, lastName, email, username, password) ";
                $sql .= "VALUES ('$firstName', '$lastName', '$email', '$username', '$password')";
                // Run the insert query
                $result = mysqli_query($db, $sql);
                // Disconnect from database
                db_disconnect($db);
                // Redirect to login in page and exit
                header("location: login.php");
                exit();
            }
            // If username is already in database (ie. taken by another user)
            else {
                $usernameError = $usernameErrorMsg;
                $usernameNotTaken = false;
            }
        }
        // If username and password not entered
        else {
            exit($registrationErrorMsg);
        }
        
    }
    // If request method == GET
    else {
        // Clear username error message
        $usernameErrorMsg = "";
        $usernameNotTaken = true;
    }
?>
<!-- Return whether username entered is taken by another user or not -->
<script>
    function usernameNotTaken() {
        return $usernameNotTaken;
    }
</script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/form_styles.css">
    <script src="../scripts/form_validation.js" defer></script>
    <title>Task Manager: Sign Up</title>
</head>
<body>
    <!-- Include header for when logged out -->
    <?php include "loggedOutHeader.php" ?>
    <main>
        <div class="formContainer">
        <h1>Sign Up</h1>
        <form action="registration.php" id="registrationForm" method="post" onsubmit="return validate() && usernameNotTaken()">

        <div class="textInputContainer">
                <!-- First name input label -->
                <label for="firstName" id="firstNameLabel">First Name</label>
                <!-- First name input field -->
                <input type="text" name="firstName" id="firstName" autocomplete="on" placeholder="First Name" value="<?php
                // If user has already tried to submit, fill value with previously entered value
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo htmlspecialchars($firstName);
                }
                ?>">
            </div>

            <div class="textInputContainer">
                <!-- Last name input label -->
                <label for="lastName" id="lastNameLabel">Last name</label>
                <!-- Last name input field -->
                <input type="text" name="lastName" id="lastName" placeholder="Last Name" value="<?php
                // If user has already tried to submit, fill value with previously entered value
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo htmlspecialchars($lastName);
                }
                ?>">
            </div>

            <div class="textInputContainer">
                <!-- Email input label -->
                <label for="email" id="emailLabel">Email Address</label>
                <!-- Email input field -->
                <input type="text" name="email" id="email" placeholder="Email" value="<?php
                // If user has already tried to submit, fill value with previously entered value
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo htmlspecialchars($email);
                }
                ?>">
            </div>

            <div class="textInputContainer">
                <!-- Username input label -->
                <label for="username" id="usernameLabel">User Name</label>
                <!-- Username input field -->
                <input type="text" name="username" id="username" placeholder="User name" value="<?php
                // If user has already tried to submit, fill value with previously entered value
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo htmlspecialchars($username);
                }
                ?>">
                <!-- Username taken error message -->
                <span class='warning' id='usernameTakenError'>
                <?php 
                    
                    if ($usernameErrorMsg) {
                    echo $usernameErrorMsg;
                } ?>
                </span>
            </div>

            <div class="textInputContainer">
                <!-- Password input label -->
                <label for="password" id="passwordLabel">Password</label>
                <!-- Password input field -->
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
        
            <div class="textInputContainer">
                <!-- Re-type password input label -->
                <label for="retype" id="retypeLabel">Re-type Password</label>
                <!-- Re-type password input field -->
                <input type="password" name="retype" id="retype" placeholder="Re-type password">
            </div>
            <!-- Link to login page (login.php) -->
            <p><a href="login.php" class="signInLink">Already have an account? Log in here.</a></p>

            <div class="formButtonsContainer">
                <!-- Submit button to register -->
                <button id="registerSubmit" name="submit" class="submit" type="submit">Sign-Up</button>
                <!-- Reset form button (clears form errors and input values) -->
                <button id="registerReset" type="reset" name="reset">Reset</button>
            </div>

        </form>

        </div>
    </main>
</body>
</html>

<!-- Disconnect from database -->
<?php 
    db_disconnect($db); 
?>
<!DOCTYPE html>
<?php

    require_once("../private/db_functions.php");
    $db = db_connect();
    $REGISTRATION_ERROR_MSG = "Error. Please enter fill in all form fields.";
    $usernameErrorMsg = "Username taken. Please try another.";
    $usernameError = "";
    $usernameNotTaken = true;

    echo '<script>console.log(' . json_encode($_SERVER["REQUEST_METHOD"]) . ');</script>';
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (!isset($_POST["reset"]) &&
        (isset($_POST["firstName"]) &&
        isset($_POST["lastName"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"]) &&
        isset($_POST["retype"]) &&
        isset($_POST["submit"]))) {
            $firstName = trim($_POST["firstName"]);
            $lastName = trim($_POST["lastName"]);
            $email = trim($_POST["email"]);
            $username = trim($_POST["username"]);
            $password = $_POST["password"];
            // Pull matching usernames from database
            $sqlTakenUsernames = "SELECT username FROM user WHERE username = '$username'";
            $takenUsernames = mysqli_query($db, $sqlTakenUsernames);
            if (mysqli_num_rows($takenUsernames) == 0) {
                $sql = "INSERT INTO user (firstName, lastName, email, username, password) ";
                $sql .= "VALUES ('$firstName', '$lastName', '$email', '$username', '$password')";
                $result = mysqli_query($db, $sql);
                db_disconnect($db);
                header("location: login.php");
                exit();
            }
            else {
                $usernameError = $usernameErrorMsg;
                $usernameNotTaken = false;
            }
        }
        else {
            exit($REGISTRATION_ERROR_MSG);
        }
        
    }
    // If request method == GET
    else {
        // Clear username error message
        $usernameErrorMsg = "";
        $usernameNotTaken = true;
    }


?>
<!-- Return to the form whether username entered is taken by another user -->
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
    <main>
        <div class="formContainer">
        <h1>Sign Up</h1>
        <form action="registration.php" id="registrationForm" method="post" onsubmit="return validate() && usernameNotTaken()">

        <div class="textInputContainer">
                <label for="firstName" id="firstNameLabel">First Name</label>
                <input type="text" name="firstName" id="firstName" autocomplete="on" placeholder="First Name" value="<?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo htmlspecialchars($firstName);//**** */
                }
                else {
                    echo '';
                }
                ?>">
            </div>

            <div class="textInputContainer">
                <label for="lastName" id="lastNameLabel">Last name</label>
                <input type="text" name="lastName" id="lastName" placeholder="Last Name" value="<?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo htmlspecialchars($lastName);
                }
                else {
                    echo '';
                }
                ?>">
            </div>

            <div class="textInputContainer">
                <label for="email" id="emailLabel">Email Address</label>
                <input type="text" name="email" id="email" placeholder="Email" value="<?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo htmlspecialchars($email);
                }
                else {
                    echo '';
                }
                ?>">
            </div>

            <div class="textInputContainer">
                <label for="username" id="usernameLabel">User Name</label>
                <input type="text" name="username" id="username" placeholder="User name" value="<?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo htmlspecialchars($username);
                }
                else {
                    echo '';
                }
                ?>">
                <span class='warning' id='usernameTakenError'>
                <?php 
                    if ($usernameErrorMsg) {
                    echo $usernameErrorMsg;
                } ?>
                </span>
            </div>

            <div class="textInputContainer">
                <label for="password" id="passwordLabel">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
        
            <div class="textInputContainer">
                <label for="retype" id="retypeLabel">Re-type Password</label>
                <input type="password" name="retype" id="retype" placeholder="Re-type password">
            </div>

            <p><a href="login.php" class="signInLink">Already have an account? Log in here.</a></p>

            <div class="formButtonsContainer">
                <button id="registerSubmit" name="submit" class="submit" type="submit">Sign-Up</button>
                <button id="registerReset" type="reset" name="reset">Reset</button>
            </div>

        </form>

        </div>
    </main>
</body>
</html>


<?php 
    db_disconnect($db); 
?>
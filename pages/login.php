
<?php
    require_once("../private/db_functions.php");
    session_start();
    $db = db_connect();
    $loginErrorMsg = "Error. Please fill in all form fields";
    $loginError = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['loginUsername'];
        $password = $_POST['loginPassword'];

        if ($username && $password) {
            $loginQuery = "SELECT user_id FROM user ";
            $loginQuery .= "WHERE username = '$username' AND password = '$password'";

            $loginResultSet = mysqli_query($db, $loginQuery);
            $rowCount = mysqli_num_rows($loginResultSet);

            if ($rowCount !== 0) {
                $loginResult = mysqli_fetch_assoc($loginResultSet);
                $userId = $loginResult["user_id"];

                $_SESSION["userId"] = $userId;
                header("location: index.php");
            }
        }
        else {
            $loginError = $loginErrorMsg;
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/form_styles.css">
    <script src="../scripts/form_validation.js" defer></script>
    <title>Task Manager: Log In</title>
</head>
<body>
    <!-- Include main header here -->
    <main>
        <div class="formContainer">
        <h1>Sign Up</h1>
        <form action="login.php" method="post" onsubmit="return validateLogin();">

            <div class="textInputContainer">
                <label for="loginUsername">User Name</label>
                <input type="text" name="loginUsername" id="loginUsername" placeholder="User name">
            </div>

            <div class="textInputContainer">
                <label for="pass">Password</label>
                <input type="password" name="loginPassword" id="loginPassword" placeholder="Password">
            </div>

            <?= "<span class='warning' id='loginErrorMsg'>$loginError</span>" ?>

            <p><a href="registration.php" class="signInLink">Click here to sign-up</a></p>
            
            <div class="formButtonsContainer">
                <button id="loginSubmit" class="submit" type="submit">Log-In</button>
            </div>

        </form>

        </div>
    </main>
</body>
</html>
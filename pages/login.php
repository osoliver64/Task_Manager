<!DOCTYPE html>
<?php
    require_once("../private/db_functions.php");
    session_start();
    $db = db_connect();
    $loginErrorMsg = "Incorrect username or password";
    $loginError = "";
    $validUser = true;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['loginUsername']) && isset($_POST["loginPassword"])) {
            $username = $_POST['loginUsername'];
            $password = $_POST['loginPassword'];

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
            else {
                $validUser = false;
                $loginError = $loginErrorMsg;
            }
        }
        else {
            $validUser = false;
        }
    }
?>
<script>
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
    <!-- Include main header here -->
    <main>
        <div class="formContainer">
        <h1>Sign Up</h1>
        <form action="login.php" method="post" onsubmit="return validateLogin() && isUserValid();">

            <div class="textInputContainer">
                <label for="loginUsername">User Name</label>
                <input type="text" name="loginUsername" id="loginUsername" placeholder="User name" value="<?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo htmlspecialchars($username);
                }
                else {
                    echo '';
                }
                ?>">
            </div>

            <div class="textInputContainer">
                <label for="loginPassword">Password</label>
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
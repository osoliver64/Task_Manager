
<?php
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/form_styles.css">
    <title>Task Manager: Log In</title>
</head>
<body>
    <!-- Include main header here -->
    <main>
        <div class="formContainer">
        <h1>Sign Up</h1>
        <form action="login.html" method="post" onsubmit="return login();">

            <div class="textInputContainer">
                <label for="username">User Name</label>
                <input type="text" name="loginUsername" id="loginUsername" placeholder="User name">
            </div>

            <div class="textInputContainer">
                <label for="pass">Password</label>
                <input type="password" name="loginPassword" id="loginPassword" placeholder="Password">
            </div>

            <p><a href="registration.php">Click here to sign-up</a></p>

            <button id="loginSubmit" class="submit" type="submit">Log-In</button>

        </form>

        </div>
    </main>
</body>
</html>
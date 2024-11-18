<?php
    db_connect();

    


    db_disconnect();
?>

<!DOCTYPE html>
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
        <div id="formContainer">
        <h1>Sign Up</h1>
        <form action="registration.html" method="get" onsubmit="return validate();">

            <div class="textInputContainer">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName" placeholder="First Name">
            </div>

            <div class="textInputContainer">
                <label for="lastName">Last name</label>
                <input type="text" name="lastName" id="lastName" placeholder="Last Name">
            </div>

            <div class="textInputContainer">
                <label for="email">Email Address</label>
                <input type="text" name="email" id="email" placeholder="Email">
            </div>

            <div class="textInputContainer">
                <label for="login">User Name</label>
                <input type="text" name="username" id="username" placeholder="User name">
            </div>

            <div class="textInputContainer">
                <label for="pass">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
        
            <div class="textInputContainer">
                <label for="retype">Re-type Password</label>
                <input type="password" name="retype" id="retype" placeholder="Re-type password">
            </div>

            <p><a href="login.html">Already have an account? Log in here.</a></p>

            <div class="formButtonsContainer">
                <button id="registerSubmit" class="submit" type="submit">Sign-Up</button>
                <button id="registerReset" type="reset">Reset</button>
            </div>

        </form>

        </div>
    </main>
</body>
</html>
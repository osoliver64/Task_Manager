
<?php
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager: Log In</title>
</head>
<body>
    <header>Task Manager</header>
    <main>
        <div id="formContainer">
        <h1>Sign Up</h1>
        <form action="login.html" method="post" onsubmit="return login();">

            <div class="textInput">
                <label for="username">User Name</label>
                <input type="text" name="username" id="username" placeholder="User name">
            </div>

            <div class="textInput">
                <label for="pass">Password</label>
                <input type="password" name="password" id="pass" placeholder="Password">
            </div>

            <p><a href="registration.html">Click here to sign-up</a></p>

            <button id="loginSubmit" class="submit" type="submit">Log-In</button>

        </form>

        </div>
    </main>
</body>
</html>
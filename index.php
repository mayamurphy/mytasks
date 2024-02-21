<?php require_once "header.php"?>
<head>
    <title>Log in | Sign Up</title>
</head>
    <div class="login-signup-page">
        <div id="login">
            <h1>Log in</h1>
            <!-- <form method="post" action="login_handler.php"> -->
            <form method="post" action="todo.php">
                <div>
                    <label for="login-un">Username:</label>
                    <input type="text" placeholder="Enter Username" id="login-un" name="un">
                </div>
                <div>
                    <label for="login-pw">Password:</label>
                    <input type="text" placeholder="Enter Password" id="login-pw" name="pw">
                </div>
                <div id="submit-button">
                    <input type="submit" value="Log in">
                </div>
            </form>
        </div>
        <div id="login-signup-separator"></div>
        <div id="signup">
            <h1>Create Account</h1>
            <!-- <form method="post" action="signup_handler.php"> -->
            <form method="post" action="todo.php">
                    <div>
                        <label for="email">E-Mail:</label>
                        <input type="text" placeholder="Enter E-Mail" id="email" name="email">
                    </div>
                    <div>
                        <label for="signup-un">Username:</label>
                        <input type="text" placeholder="Enter Username" id="signup-un" name="un">
                    </div>
                    <div>
                        <label for="signup-pw">Password:</label>
                        <input type="text" placeholder="Enter Password" id="signup-pw" name="pw">
                    </div>
                    <div>
                        <label for="signup-reenter-pw">Re-enter Password:</label>
                        <input type="text" placeholder="Re-enter Password" id="signup-reenter-pw" name="pw">
                    </div>
                    <div id="submit-button">
                        <input type="submit" value="Sign Up!">
                    </div>
                </form>
        </div>
    </div>
    <?php require_once "footer.php" ?>
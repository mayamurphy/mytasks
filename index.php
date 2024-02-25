<html>
<head>
    <link rel="stylesheet" href="style.css"/>
    <title>Log in | Sign Up</title>
</head>
<body id="login-signup-body">
    <img src="images/mytasks logo.png"/>
    <link id="header-pfp" rel="icon" type="image/png" href="images/mytasks.png"/>
    <hr>
    <div class="login-signup-page">
        <div id="login">
            <h1>Log in</h1>
            <form method="post" action="login_handler.php">
                <div>
                    <label for="login-un">Username:</label>
                    <input type="text" placeholder="Enter Username" id="login-un" name="un">
                </div>
                <div>
                    <label for="login-pw">Password:</label>
                    <input type="password" placeholder="Enter Password" id="login-pw" name="pw">
                </div>
                <div id="submit-button">
                    <input type="submit" value="Log in">
                </div>
            </form>
        </div>
        <div id="login-signup-separator"></div>
        <div id="signup">
            <h1>Create Account</h1>
            <form method="post" action="signup_handler.php">
                    <div>
                        <label for="signup-email">E-Mail:</label>
                        <input type="email" placeholder="Enter E-Mail" id="signup-email" name="email">
                    </div>
                    <div>
                        <label for="signup-un">Username:</label>
                        <input type="text" placeholder="Enter Username" id="signup-un" name="un">
                    </div>
                    <div>
                        <label for="signup-pw">Password:</label>
                        <input type="password" placeholder="Enter Password" id="signup-pw" name="pw">
                    </div>
                    <div>
                        <label for="signup-reenter-pw">Re-enter Password:</label>
                        <input type="password" placeholder="Re-enter Password" id="signup-reenter-pw" name="signup-reenter-pw">
                    </div>
                    <div id="submit-button">
                        <input type="submit" value="Sign Up!">
                    </div>
                </form>
        </div>
    </div>
    <?php require_once "footer.php" ?>
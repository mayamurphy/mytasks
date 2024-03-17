<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="login-signup.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen+Mono"/>
    <title>Sign up</title>
</head>
<body class="login-signup-body">
    <div class="header">
        <img src="images/mytasks logo.png"/>
    </div>
    <hr>
    <div class="content">
        <div class="left">
            <div class="login-redir">
                <h1>Already have an account?</h1>
                <div class="login-redir-button">
                    <button><a href="login.php">Log in</a></button>
                </div>
            </div>
        </div>
        <div id="vert-div"></div>
        <div class="right">
            <div class="signup">
                <div class="signup-form">
                    <h1>Create Account</h1>
                    <div class="error-messages">
                        <?php
                            if (isset($_SESSION['messages'])) {
                                foreach ($_SESSION['messages'] as $message) {
                                    echo "<div class='message' id='" . $_SESSION['sentiment'] . "'>{$message}</div>";
                                }
                                unset($_SESSION['messages']);
                            }
                        ?>
                    </div>
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
        </div>
    </div>
<?php require_once "footer.php"; ?>

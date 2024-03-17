<!DOCTYPE html>
<?php 
    session_start();
    require_once "Dao.php";
?>
<html>
<head>
    <link rel="stylesheet" href="login-signup.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen+Mono"/>
    <title>Log in</title>
</head>
<body class="login-signup-body">
    <div class="header">
        <img src="images/mytasks logo.png"/>
    </div>
    <hr>
    <div class="content">
        <div class="left">
            <div class="login">
                <div class="login-form">
                    <h1>Log in</h1>
                    <div class="error-messages">
                        <?php
                            if (isset($_SESSION['messages'])) {
                                foreach ($_SESSION['messages'] as $message) {
                                    echo "<div class='message'>{$message}</div>";
                                }
                                unset($_SESSION['messages']);
                            }
                        ?>
                    </div>
                    <form method="post" action="login_handler.php">
                        <div>
                            <label for="login-un">Username:</label>
                            <input type="text" placeholder="Enter Username" id="login-un" name="login-un">
                        </div>
                        <div>
                            <label for="login-pw">Password:</label>
                            <input type="password" placeholder="Enter Password" id="login-pw" name="login-pw">
                        </div>
                        <div id="submit-button">
                            <input type="submit" value="Log in">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="vert-div"></div>
        <div class="right">
            <div class="signup-redir">
                <h1>Don't have an account?</h1>
                <div class="signup-redir-button">
                    <button><a href="signup.php">Sign up</a></button>
                </div>
            </div>
        </div>
    </div>
<?php require_once "footer.php"; ?>

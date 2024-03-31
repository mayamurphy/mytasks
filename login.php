<!DOCTYPE html>
<?php 
    session_start();
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
      header("Location: todo.php");
      exit();
    }
    require_once "Dao.php";
?>
<html>
    <head>
        <link rel="stylesheet" href="css/login-signup.css"/>
        <link rel="stylesheet" href="css/footer.css"/>
        <link id="header-pfp" rel="icon" type="image/png" href="images/mytasks.png"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen+Mono"/>
        <title>Log in</title>
    </head>
    <body class="login-signup-body">
        <div class="header">
            <img src="images/mytasks logo.png"/>
            <hr>
        </div>
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
                                <input type="text" placeholder="Enter Username" id="login-un" name="login-un"
                                    value="<?php echo isset($_SESSION['inputs']['login-un']) ? $_SESSION['inputs']['login-un'] : ""; ?>">
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
        <?php require_once "footer.php" ?>
    </body>
</html>
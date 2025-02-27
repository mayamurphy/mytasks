<!DOCTYPE html>
    <head>
        <title>Settings</title>
    </head>
    <?php require_once "header.php"?>
        <div class="content">
            <div class="nav-bar">
                <ol>
                    <li><a href="todo.php">To Do</a></li>
                    <li><a href="completed.php">Completed</a></li>
                    <li><a href="all-tasks.php">All</a></li>
                </ol>
            </div>
            <div class="settings">
                <h1>ACCOUNT SETTINGS</h1>
                <hr>
                <div class="user-info">
                    <?php
                        $user_info = $dao->getUserInfo($_SESSION['username']);
                        echo    "<div class='display-pfp'>
                                    <img src='". $user_info[0]['pfp_link']."'>
                                    <button><a href='settings/update_pfp.php'>&#x1F589</a></button>
                                </div>
                                <div class='display-user-info'>
                                    <div id='display-un'>Username: " . 
                                        htmlspecialchars($user_info[0]['username']) . 
                                    "</div>";
                        echo        "<div id='display email'>
                                        E-mail: " . htmlspecialchars($user_info[0]['email']) . 
                                    "   <button><a href='settings/update_email.php'>&#x1F589</a></button></div>
                                    <div id='display pw'>
                                        Password: "; 
                                        for ($x = 0; $x <= 7; $x++) {
                                            echo '&#8226';
                                        }
                        echo        "   <button><a href='settings/update_password.php'>&#x1F589</a></button></div>
                                </div>";
                    ?>
                </div>
                <div class="delete-account-button"><button><a href="settings/delete_account.php">Delete Account</a></button></div>
            </div>
        </div>
        <?php require_once "footer.php" ?>
    </body>
</html>
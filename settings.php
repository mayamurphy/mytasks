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
                <?php
                    $user_info = $dao->getUserInfo($_SESSION['username']);
                    echo "Username: " . $user_info[0]['username'];
                    echo "E-mail: " . $user_info[0]['email'];
                ?>
            </div>
        </div>
        <?php require_once "footer.php" ?>
    </body>
</html>
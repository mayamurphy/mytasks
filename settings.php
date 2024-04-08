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
                                    <button onClick='openUpdatePFP()'>&#x1F589</button>
                                    <div id='update-pfp'>
                                        <form method='post' action='settings/profile-image-update_handler.php'>
                                            <label for='pfp-image'>Pick a Profile Image</label>
                                            <select name='pfp-image'>
                                                <option>insert something</option>
                                            </select>
                                            <button type='submit'>Save Changes</button>
                                        </form>
                                        <button onClick='closeUpdatePFP()'>Cancel</button>
                                    </div>
                                </div>
                                <div class='display-user-info'>
                                    <div id='display un'>Username: " . 
                                        $user_info[0]['username'] . 
                                    "</div>";
                        echo        "<div id='display email'>
                                        E-mail: " . $user_info[0]['email'] . 
                                    "</div>
                                    <div id='update email'>
                                        <button>&#x1F589</button>
                                    </div> 
                                    <div id='display pw'>
                                        Password: "; 
                                        foreach(str_split($user_info[0]['password']) as $char) {
                                            echo '&#8226';
                                        }
                        echo        "</div>
                                    <div id='update pw'>
                                        <button>&#x1F589</button>
                                    </div> 
                                </div>";
                    ?>
                </div>
            </div>
        </div>
        <?php require_once "footer.php" ?>
    </body>
</html>
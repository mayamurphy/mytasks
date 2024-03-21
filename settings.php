<?php require_once "header.php"; ?>
<head>
    <link rel="stylesheet" href="settings.css"/>
    <title>Settings</title>
</head>
<div id="content">
    <div id="nav">
    <ol>
        <li><a href="todo.php">To Do</a></li>
        <li><a href="completed.php">Completed</a></li>
        <li id="curr-page"><a href="settings.php">Settings</a></li>
    </ol>
</div>
<div class="settings">
    <h1>ACCOUNT SETTINGS</h1>
    <hr>
    <form method="post" action="settings_handler.php">
        <!-- show image prof -- let user change it -->
        <div id="profile-image">
            <img src="images/Default_pfp.png"/>
        </div>
        <div id="user-info">
            <div>
                <label for="un">Username:</label>
                <!-- get username from database -->
                <input type="text" placeholder="Username" id="un" name="un" disabled>
            </div>
            <div>
                <label for="email">E-Mail:</label>
                <!-- update placeholder to show user's email -->
                <input type="email" placeholder="Enter E-Mail" id="email" name="email">
            </div>
            <div>
                <label for="old-pw">Old Password:</label>
                <input type="password" placeholder="Enter Old Password" id="old-pw" name="pw">
            </div>
            <div>
                <label for="new-pw">New Password:</label>
                <input type="password" placeholder="Enter New Password" id="new-pw" name="pw">
            </div>
            <div>
                <label for="reenter-new-pw">Re-enter New Password:</label>
                <input type="password" placeholder="Re-enter New Password" id="reenter-new-pw" name="pw">
            </div>
        </div>
        <div id="submit-button">
            <input type="submit" value="Save Changes">
        </div>
    </form>
</div>
<?php require_once "footer.php"; ?>
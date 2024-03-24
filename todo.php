<!DOCTYPE html>
<?php 
    session_start();
    
    require_once 'Dao.php';
    $dao = new Dao();
    $_SESSION['todays_progress'] = $dao->getTodaysProgress();
?>
<html>
    <head>
        <link rel="stylesheet" href="todo.css"/>
        <link rel="stylesheet" href="progress-bar-style.php"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen+Mono"/>
        <link id="header-pfp" rel="icon" type="image/png" href="images/mytasks.png"/>
        <title>TODO LIST</title>
    </head>
    <body>
        <div class="header">
            <div class="header-logo"><img src="images/mytasks logo.png"/></div>
            <div class="welcome-username">
                <p>Welcome <?php echo $_SESSION['username'] ?>!</p>
            </div>
            <div class="user-dropdown">
                <img src="images/Default_pfp.png" alt="default profile picture">
                <div class="dropdown-content">
                    <a href="settings.php">Settings</a>
                    <a href="logout.php">Log out</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="content">
            <div class="nav-bar">
                <ol>
                    <li id="curr-page"><a href="todo.php">To Do</a></li>
                    <li><a href="completed.php">Completed</a></li>
                </ol>
            </div>
            <div class="tasks">
                <h1>MY TASKS:</h1>
                <?php require_once "tasks.php"?>
                <!-- populate table -->
            </div>
            <div class="progress-bar-and-cal">
                <div class="progress-bar-container">
                    <h2>Today's Progress:</h2>
                    <!-- calc today's progress -->
                    <div class="progress-bar">
                        <div id="progress">
                            <div id="progress-percent">
                                <?php echo $_SESSION['todays_progress']; ?>%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="calendar">
                    <h1><?php echo date("F"); ?></h1>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <?php require_once "footer.php" ?>
    </body>
</html>
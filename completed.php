<?php require_once "header.php"; ?>
<html>
<head>
    <link rel="stylesheet" href="style.css"/>
    <title>Completed</title>
</head>
<div id="content">
    <div id="nav">
    <ol>
        <li><a href="todo.php">To Do</a></li>
        <li id="curr-page"><a href="completed.php">Completed</a></li>
        <li><a href="settings.php">Settings</a></li>
    </ol>
    </div>
    <div class="left">
        <h1>COMPLETED TASKS:</h1>
        <div id="completed">
            <div class="task-list">
                <?php require_once "tasks.php" ?>
            </div>
        </div>
    </div>
<?php require_once "progress_bar_and_calendar.php"; ?>
<?php require_once "footer.php"; ?>
<?php require_once "header.php"; ?>
<html>
<head>
    <link rel="stylesheet" href="style.css"/>
    <title>TODO</title>
</head>
<div id="content">
    <div id="nav">
    <ol>
        <li id="curr-page"><a href="todo.php">To Do</a></li>
        <li><a href="completed.php">Completed</a></li>
        <li><a href="settings.php">Settings</a></li>
    </ol>
    </div>
    <div class="left">
        <div id="todo">
            <h1>MY TASKS:</h1>
            <div class="task-list">
                <?php require_once "tasks.php" ?>
                <button type="button">+</button>
            </div>
        </div>
    </div>
<?php require_once "progress_bar_and_calendar.php"; ?>
<?php require_once "footer.php"; ?>
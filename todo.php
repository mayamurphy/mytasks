<?php require_once "header.php"; ?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>TODO ✅</title>
</head>
<div class="left">
    <div id="todo">
        <div class="task-list">
            <?php require_once "tasks.php" ?>
        </div>
    </div>
</div>
<?php require_once "progress_bar_and_calendar.php"; ?>
<?php require_once "footer.php"; ?>
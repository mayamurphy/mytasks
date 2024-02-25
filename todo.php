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
                <script>
                    function openForm() {
                        document.getElementById("add-task-form").style.display = "block";
                    }

                    function closeForm() {
                        document.getElementById("add-task-form").style.display = "none";
                    }
                </script>
                <button type="button" onclick="openForm()">+</button>
                <div id="add-task-form">
                    <form method="post" action="add_task_handler.php">
                        <h2>ADD TASK</h2>
                        <label for="task_name">Name:</label>
                        <input type="text" name="task_name" id="task_name" required>
                        <label for="task_desc">Description:</label>
                        <input type="text" name="task_desc" id="task_desc">
                        <label for="task_due">Due:</label>
                        <input type="date" name="task_due" id="task_due" required>
                        <label for="task_color">Color:</label>
                        <input type="color" name="task_color" id="task_color">
                        <label for="task_status">Status:</label>
                        <select name="task_status">
                            <option value="Not Started">Not Started</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                        <button id="add-task-button" type="submit" onclick="closeForm()">Add Task</button>
                        <button id="close-task-button" type="button" onclick="closeForm()">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once "progress_bar_and_calendar.php"; ?>
<?php require_once "footer.php"; ?>
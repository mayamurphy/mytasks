        <head>
            <title>TO DO LIST</title>
        </head>
        <?php require_once "header.php"?>
        <div class="content">
            <div class="nav-bar">
                <ol>
                    <li id="curr-page"><a href="todo.php">To Do</a></li>
                    <li><a href="completed.php">Completed</a></li>
                    <li><a href="all-tasks.php">All</a></li>
                </ol>
            </div>
            <div class="tasks">
                <h1>TASKS TO DO:</h1>
                <table class="tasks-table">
                    <thead>
                        <tr>
                            <th id="tt-name">Name</th>
                            <th id="tt-desc">Description</th>
                            <th id="tt-due">Due</th>
                            <th id="tt-color">Color</th>
                            <th id="tt-status">Status</th>
                        </tr>
                    </thead>
                    <?php
                    $lines = $dao->getTodoTasks();
                    foreach ($lines as $line) {
                        echo "<tr>
                        <td>{$line['task_name']}</td>
                        <td>{$line['task_desc']}</td>
                        <td>{$line['task_due']}</td>
                        <td>{$line['task_color']}</td>
                        <td>{$line['task_status']}</td>
                        </tr>";
                    }
                    ?> 
                </table>
            </div>
            <?php require_once "progress_bar_and_calendar.php"?>
        </div>
        <?php require_once "footer.php" ?>
    </body>
</html>
<!DOCTYPE html>
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
                <div class="tasks-table">
                    <table>
                        <?php
                            require_once "tasks_form.php";
                            $lines = $dao->getTodoTasks();
                            foreach ($lines as $line) {
                                echo "<tr>
                                    <td id='tt-placeholder'>
                                        <div class='mark-completed'>
                                            <button>&#10004</button>
                                        </div>
                                    </td>
                                    <td id='tt-name'>{$line['task_name']}</td>
                                    <td id='tt-desc'>{$line['task_desc']}</td>
                                    <td id='tt-due'>{$line['task_due']}</td>
                                    <td id='tt-color'>{$line['task_color']}</td>
                                    <td id='tt-status'>{$line['task_status']}</td>
                                    <td id='tt-placeholder'>
                                        <div class='task-dropdown'>
                                            <div class='task-dropdown-vert-dots'>
                                                <button><div id='dot'></div>
                                                <div id='dot'></div>
                                                <div id='dot'></div></button>
                                            </div>
                                            <div class='task-dropdown-content'>
                                                <a href='#'>Edit</a>
                                                <a href='#'>Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>";
                            }
                        ?> 
                    </table>
                </div>
            </div>
            <?php require_once "progress_bar_and_calendar.php"?>
        </div>
        <?php require_once "footer.php" ?>
    </body>
</html>
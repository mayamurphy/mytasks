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
                <div class="add-task">
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
                            <input type="date" name="task_due" id="task_due" value="<?php echo date('Y-m-d', strtotime('+7 day'))?>">
                            <label for="task_color">Color:</label>
                            <select id="task_color_choices" name="task_color">
                                <option value="#000000">#000000</option>
                                <option value="#ff0000">#ff0000</option>
                                <option value="#00ff00">#00ff00</option>
                                <option value="#808080">#808080</option>
                                <option value="#ffffff">#ffffff</option>
                                <option value="#ffc0cb">#ffc0cb</option>
                            </select>
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
                <div class="tasks-table">
                    <table>
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
            </div>
            <?php require_once "progress_bar_and_calendar.php"?>
        </div>
        <?php require_once "footer.php" ?>
    </body>
</html>
<!DOCTYPE html>
        <head>
            <title>COMPLETED TASKS</title>
        </head>
        <?php require_once "header.php"?>
        <div class="content">
            <div class="nav-bar">
                <ol>
                    <li><a href="todo.php">To Do</a></li>
                    <li id="curr-page"><a href="completed.php">Completed</a></li>
                    <li><a href="all-tasks.php">All</a></li>
                </ol>
            </div>
            <div class="tasks">
                <h1>COMPLETED TASKS:</h1>
                <div class="tasks-table">
                    <table>
                        <thead>
                            <tr>
                                <th id="tt-placeholder"></th>
                                <th id="tt-name">Name</th>
                                <th id="tt-desc">Description</th>
                                <th id="tt-due">Due</th>
                                <th id="tt-color">Color</th>
                                <th id="tt-status">Status</th>
                                <th id="tt-placeholder"></th>
                            </tr>
                        </thead>
                        <tr class="add-task">
                            <td id="tt-placeholder"></td>
                            <form id="add-task-form" method="post" action="add_task_handler.php">
                                <input type="hidden" name="location" value="completed.php">
                                <td id="tt-name"><input type="text" name="task_name" id="task_name" required></td>
                                <td id="tt-desc"><input type="text" name="task_desc" id="task_desc"></td>
                                <td id="tt-due"><input type="date" name="task_due" id="task_due" value="<?php echo date('Y-m-d')?>" required></td>
                                <td id="tt-color"><input type="color" name="task_color" id="task_color"></td>
                                <td id="tt-status">
                                    <select name="task_status">
                                        <option value="Not Started">Not Started</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </td>
                                <td><button id="add-task-button" type="submit">+</button></td>
                            </form>
                        </tr>
                        <?php
                            $lines = $dao->getCompletedTasks($_SESSION['user_id']);
                            foreach ($lines as $line) {
                                echo "<tr>
                                    <td id='tt-placeholder'>
                                        <div class='mark-completed'>
                                            <form method='post' action='task_status_handler.php'>
                                                <input type='hidden' name='location' value='completed.php'>
                                                <input type='hidden' name='task_id' value='{$line['task_id']}'>";
                                echo ('Completed' == $line['task_status']) ? 
                                                "<input type='hidden' name='new_task_status' value='Not Started'>" 
                                                :  "<input type='hidden' name='new_task_status' value='Completed'>";
                                echo            "<button type='submit'>&#10004</button>
                                            </form>
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
                                                <div class='edit-task'>
                                                    <button type='button' onClick='editTaskForm()'>Edit</button>
                                                </div>
                                                <div class='delete-task'>
                                                    <form method='post' action='delete_task_handler.php'>
                                                        <input type='hidden' name='location' value='completed.php'>
                                                        <input type='hidden' name='task_id' value='{$line['task_id']}'>
                                                        <button type='submit'>Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div id='edit-task-form'>
                                    <div class='top-of-form'>
                                        <h2>Edit task</h2>
                                        <button onClick='closeEditTaskForm()'>Close X</button>
                                    </div>
                                    <form method='post' action='task_edit_handler.php'>
                                        <input type='hidden' name='location' value='completed.php'>
                                        <input type='hidden' name='task_id' value='{$line['task_id']}'>
                                        <div class='task_name'>
                                            <label for='task_name'>Task name:</label>
                                            <textarea name='task_name' required>{$line['task_name']}</textarea>
                                        </div>
                                        <div class='task_desc'>
                                            <label for='task_desc'>Task desc:</label>
                                            <textarea name='task_desc'>{$line['task_desc']}</textarea>
                                        </div>
                                        <div class='not-textarea'>
                                            <div class='task_due'>
                                                <label for='task_due'>Task due date:</label>
                                                <input type='date' name='task_due' value='{$line['task_due']}' required>
                                            </div>
                                            <div class='task_color'>
                                                <label for='task_color'>Task color:</label>
                                                <input type='color' name='task_color' value='{$line['task_color']}'>
                                            </div>
                                            <div class='task_status'>
                                                <label for='task_status'>Task status:</label>
                                                <select name='task_status' value='{$line['task_status']}'>
                                                    <option value='Not Started'>Not Started</option>
                                                    <option value='In Progress'>In Progress</option>
                                                    <option value='Completed'>Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class='button'><button type='submit'>Save Changes</button></div>
                                    </form>
                                </div>";
                            }
                        ?> 
                    </table>
                <?php require_once 'main_content_footer.php'?>
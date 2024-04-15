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
                                <input type="hidden" name="location" value="todo.php">
                                <td id="tt-name"><input type="text" name="task_name" id="task_name"
                                    value="<?php echo isset($_SESSION['inputs']['task_name']) ? htmlspecialchars($_SESSION['inputs']['task_name']) : ""; ?>" required></td>
                                <td id="tt-desc"><input type="text" name="task_desc" id="task_desc"
                                    value="<?php echo isset($_SESSION['inputs']['task_desc']) ? htmlspecialchars($_SESSION['inputs']['task_desc']) : ""; ?>"></td>
                                <td id="tt-due"><input type="date" name="task_due" id="task_due" 
                                    value="<?php echo isset($_SESSION['inputs']['task_due']) ? htmlspecialchars($_SESSION['inputs']['task_due']) : date('Y-m-d')?>" required></td>
                                <td id="tt-color"><input type="color" name="task_color" id="task_color"
                                    value="<?php echo isset($_SESSION['inputs']['task_color']) ? htmlspecialchars($_SESSION['inputs']['task_color']) : "#000000"; ?>"></td>
                                <td id="tt-status">
                                    <select name="task_status">
                                        <option value="Not Started" selected>Not Started</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </td>
                                <td><button id="add-task-button" type="submit">+</button></td>
                            </form>
                        </tr>
                        <?php
                            $lines = $dao->getTodoTasks($_SESSION['user_id']);
                            foreach ($lines as $line) {
                                echo "<tr>
                                    <td id='tt-placeholder'>
                                        <div class='mark-completed'>
                                            <form method='post' action='task_status_handler.php'>
                                                <input type='hidden' name='location' value='todo.php'>
                                                <input type='hidden' name='task_id' value='{$line['task_id']}'>";
                                echo ('Completed' == $line['task_status']) ? 
                                                "<input type='hidden' name='new_task_status' value='Not Started'>" 
                                                :  "<input type='hidden' name='new_task_status' value='Completed'>";
                                echo            "<button type='submit'>&#10004</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td id='tt-name'>" . htmlspecialchars($line['task_name']) . "</td>
                                    <td id='tt-desc'>" . htmlspecialchars($line['task_desc']) . "</td>
                                    <td id='tt-due'>" . htmlspecialchars($line['task_due']) . "</td>
                                    <td id='tt-color'><div id='display-color' style='background-color:" . htmlspecialchars($line['task_color']) . "'></div></td>
                                    <td id='tt-status'>" . htmlspecialchars($line['task_status']) . "</td>
                                    <td id='tt-placeholder'>
                                        <div class='task-dropdown'>
                                            <div class='task-dropdown-vert-dots'>
                                                <button><div id='dot'></div>
                                                <div id='dot'></div>
                                                <div id='dot'></div></button>
                                            </div>
                                            <div class='task-dropdown-content'>
                                                <div class='edit-task'>
                                                    <button type='button' onClick='openEditTaskForm({$line['task_id']})'>Edit</button>
                                                </div>
                                                <div class='delete-task'>
                                                    <form method='post' action='delete_task_handler.php'>
                                                        <input type='hidden' name='location' value='todo.php'>
                                                        <input type='hidden' name='task_id' value='{$line['task_id']}'>
                                                        <button type='submit'>Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class='edit-task-form' id='{$line['task_id']}'>
                                    <div class='top-of-form'>
                                        <h2>Edit task</h2>
                                        <button onClick='closeEditTaskForm({$line['task_id']})'>Close X</button>
                                    </div>
                                    <form method='post' action='task_edit_handler.php'>
                                        <input type='hidden' name='location' value='todo.php'>
                                        <input type='hidden' name='task_id' value='{$line['task_id']}'>
                                        <div class='task_name'>
                                            <label for='task_name'>Task name:</label>
                                            <textarea name='task_name'>";
                                            echo isset($_SESSION['inputs']['task_name']) ? htmlspecialchars($_SESSION['inputs']['task_name']) : htmlspecialchars($line['task_name']);
                                echo        "</textarea>
                                        </div>
                                        <div class='task_desc'>
                                            <label for='task_desc'>Task desc:</label>
                                            <textarea name='task_desc'>";
                                            echo isset($_SESSION['inputs']['task_desc']) ? htmlspecialchars($_SESSION['inputs']['task_desc']) : htmlspecialchars($line['task_desc']);
                                echo        "</textarea>
                                        </div>
                                        <div class='not-textarea'>
                                            <div class='task_due'>
                                                <label for='task_due'>Task due date:</label>
                                                <input type='date' name='task_due' value='";
                                                echo htmlspecialchars($line['task_due']);
                                echo            "' required>
                                            </div>
                                            <div class='task_color'>
                                                <label for='task_color'>Task color:</label>
                                                <input type='color' name='task_color' value='";
                                                echo htmlspecialchars($line['task_color']);
                                echo            "'>
                                            </div>
                                            <div class='task_status'>
                                                <label for='task_status'>Task status:</label>
                                                <select name='task_status'>
                                                    <option value='Not Started' ";
                                                    echo (isset($_SESSION['inputs']['task_status']) && ("Not Started" == $_SESSION['inputs']['task_status'])) ? "selected"
                                                                    : ("Not Started" == htmlspecialchars($line['task_status']) ? "selected": "");
                                                    echo ">Not Started</option>
                                                    <option value='In Progress' ";
                                                    echo (isset($_SESSION['inputs']['task_status']) && ("In Progress" == $_SESSION['inputs']['task_status'])) ? "selected"
                                                                    : ("In Progress" == htmlspecialchars($line['task_status']) ? "selected": "");
                                                    echo ">In Progress</option>
                                                    <option value='Completed' ";
                                                    echo (isset($_SESSION['inputs']['task_status']) && ("Completed" == $_SESSION['inputs']['task_status'])) ? "selected"
                                                                    : ("Completed" == htmlspecialchars($line['task_status']) ? "selected": "");
                                                    echo ">Completed</option>
                                                </select>
                                            </div>
                                        </div>";
                                        if (isset($_SESSION['inputs'])) {unset($_SESSION['inputs']);}
                                        echo "<div class='button'><button type='submit'>Save Changes</button></div>
                                    </form>
                                </div>";
                            }
                        ?> 
                    </table>
                    <?php require_once 'main_content_footer.php'?>
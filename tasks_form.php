<!DOCTYPE html>
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
                                <td><input type="text" name="task_name" id="task_name" required></td>
                                <td><input type="text" name="task_desc" id="task_desc"></td>
                                <td><input type="date" name="task_due" id="task_due" required></td>
                                <td><input type="color" name="task_color" id="task_color"></td>
                                <td>
                                    <select name="task_status">
                                        <option value="Not Started">Not Started</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </td>
                                <td><button id="add-task-button" type="submit">+</button></td>
                            </form>
                        </tr>